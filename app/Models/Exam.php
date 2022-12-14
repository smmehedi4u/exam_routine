<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'exam_year',
        'type',
        'batch_id',
        "year",
        'semester',
    ];

    public function getTypeAttribute()
    {
        if ($this->attributes['type'] == 1) {
            return "CT";
        }
        return "Semester Final";
    }

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }

    public function routines()
    {
        return $this->hasMany(Routine::class);
    }
}
