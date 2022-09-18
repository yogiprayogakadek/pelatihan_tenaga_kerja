<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Participant extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $table = 'participants';

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
    
    public function registration()
    {
        return $this->belongsTo(Registration::class, 'id', 'participant_id');
    }

    public function attendance()
    {
        return $this->hasMany(Attendance::class, 'participant_id', 'id');
    }
}
