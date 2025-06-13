<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Project;

class CapaRequest extends Model
{
 
    protected $appends = ['user_name','projectname'];
    protected $hidden = ['user','project'];


    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }
    public function getProjectNameAttribute(){
        return $this->project ? $this->project->name : null;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'approver_id'); 
    }
     public function project()
    {
        return $this->belongsTo(Project::class, 'project_id'); 
    }

    
  
}
