<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Teacher extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'title',
        'department_id',
        'contact',
        'email',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function invigilation_duties()
    {
        return $this->belongsToMany(Routine::class, "exam_duties", "teacher_id", "routine_id");
    }
    public function supervising_duties()
    {
        return $this->belongsToMany(Routine::class, "routine_supervisor", "teacher_id", "routine_id");
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }

}
