<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
     // Une tâche appartient à un projet
     public function project()
     {
        
         return $this->belongsTo(Project::class,'project_id','id');
     }
}