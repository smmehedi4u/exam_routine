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

    public function exam_duties()
    {
        return $this->hasMany(ExamDuty::class);
    }
}
