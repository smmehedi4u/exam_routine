<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamDuty extends Model
{
    use HasFactory;

    protected $fillable = [
        'teacher_id',
        'routine_id',
    ];
    
    public function teacher()
    {
        return $this->belongsTo(Teacher::class);
    }

    public function routine()
    {
        return $this->belongsTo(Routine::class);
    }

    
}
