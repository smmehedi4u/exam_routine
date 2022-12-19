<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Routine extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_id',
        'subject_id',
        'exam_date',
        'exam_time',
        'exam_center_id',
        'teacher_id',
    ];

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }
    public function exam()
    {
        return $this->belongsTo(Exam::class);
    }

    public function exam_duties()
    {
        return $this->hasMany(ExamDuty::class);
    }

    public function exam_center()
    {
        return $this->belongsTo(ExamCenter::class);
    }
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }
}
