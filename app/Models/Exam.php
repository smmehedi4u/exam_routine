<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'year',
        'type',
        'batch_id',
        'semester',
    ];

    public function batch()
    {
        return $this->belongsTo(Batch::class);
    }
}
