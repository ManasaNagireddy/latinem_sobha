<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Carbon\Carbon;

class CapaRequestsTableSeeder extends Seeder
{
    public function run()
    {
        $batchSize = 1000; // Insert in batches
        $totalRows = 100000;
        $projectIds = range(1, 10);
        $towerIds = range(1, 20);
        $divisionIds = range(1, 5);
        $activityIds = range(1, 15);
        $subActivityIds = range(1, 30);
        $defectTypes = ['Crack', 'Leak', 'Discoloration', 'Misalignment', 'Other'];
        $statuses = ['open', 'closed', 'rejected']; 
        $approverIds = range(1, 10);

        for ($i = 0; $i < $totalRows; $i += $batchSize) {
            $batch = [];

            for ($j = 0; $j < $batchSize; $j++) {
                $batch[] = [
                    'project_id' => $projectIds[array_rand($projectIds)],
                    'tower_id' => $towerIds[array_rand($towerIds)],
                    'division_id' => $divisionIds[array_rand($divisionIds)],
                    'activity_id' => $activityIds[array_rand($activityIds)],
                    'sub_activity_id' => $subActivityIds[array_rand($subActivityIds)],
                    'defect_type' => $defectTypes[array_rand($defectTypes)],
                    'defect_count' => rand(1, 20),
                    'created_at' => Carbon::now()->subDays(rand(0, 365)),
                    'status' => $statuses[array_rand($statuses)],
                    'approver_id' => $approverIds[array_rand($approverIds)],
                ];
            }

            DB::table('capa_requests')->insert($batch);
        }
    }
}
