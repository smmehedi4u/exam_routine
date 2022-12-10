<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\SoftDeletes;

class Department extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
    ];

    public function batches()
    {
        return $this->hasMany(Batch::class);
    }

    public function teacher()
    {
        return $this->hasMany(Teacher::class);
    }
}
