<?php

use App\Models\Participant;
use App\Models\Registration;

    function participant_document()
    {
        $participant = Participant::where('user_id', auth()->user()->id)->first();
        return array_count_values(json_decode($participant->documents, true))['empty'] ?? 0;
    }

    function registration()
    {
        $registration = Registration::where('participant_id', auth()->user()->participant->id)->first();
        return $registration;
    }

    