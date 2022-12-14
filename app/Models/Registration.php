<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'registrations';

    public function participant()
    {
        return $this->hasOne(Participant::class, 'participant_id', 'id');
    }
}
