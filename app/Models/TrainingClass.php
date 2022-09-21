<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TrainingClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'classes';

    public function assessor()
    {
        return $this->belongsTo(Assessor::class, 'assessor_id', 'id');
    }

    public function participant()
    {
        return $this->hasMany(Participant::class, 'class_id', 'id');
    }
}
