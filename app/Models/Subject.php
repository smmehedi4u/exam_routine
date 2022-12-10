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
        'batch_id',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function routine()
    {
        return $this->hasMany(Routine::class);
    }
}
