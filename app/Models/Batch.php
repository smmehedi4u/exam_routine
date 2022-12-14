<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Batch extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'department_id',
        'session',
    ];

    public function department()
    {
        return $this->belongsTo(Department::class);
    }

    public function exam()
    {
        return $this->hasMany(Exam::class);
    }

}
