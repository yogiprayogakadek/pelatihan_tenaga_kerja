<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ParticipantClass extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'participant_classes';

    public function participant()
    {
        return $this->belongsTo(Participant::class, 'participant_id', 'id');
    }

    public function trainingClass()
    {
        return $this->belongsTo(TrainingClass::class, 'class_id', 'id');
    }
}
