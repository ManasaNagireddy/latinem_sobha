<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class CapaRequest extends Model
{
 
    protected $appends = ['user_name'];
    protected $hidden = ['user'];


    public function getUserNameAttribute()
    {
        return $this->user ? $this->user->name : null;
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'approver_id'); 
    }
  
}
