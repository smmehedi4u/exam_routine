<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model
{
    use HasFactory;

    protected $fillable = [
        'course_name',
        'course_code',
        'year',
        'semester',
        'department_id',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function routines()
    {
        return $this->belongsToMany(Routine::class);
    }
}
