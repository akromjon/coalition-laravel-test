<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'priority', 'project_id'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    const PRIORITY_LOW = 3;
    const PRIORITY_MEDIUM = 2;
    const PRIORITY_HIGH = 1;
}
