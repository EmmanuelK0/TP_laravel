<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    // Un projet peut avoir plusieurs tâches
    public function tasks()
    {
        return $this->hasMany(Task::class,'project_id','id');
    }
}