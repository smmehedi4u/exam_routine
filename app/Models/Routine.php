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
}
