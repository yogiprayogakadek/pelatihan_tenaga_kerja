<?php

use App\Models\Announcement;
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

    function menu()
    {
        $menu = [
            ['Participant', 'Participants', 'i-Business-ManWoman'], 
            ['Assessor', 'Assessors', 'i-Administrator'], 
            ['TrainingClass', 'Classes', 'i-Computer-Secure']
        ];
        // $menu = [
        //     'Participant', 'Assessor', 'TrainingClass'
        // ];

        return $menu;
    }

    function total_data($model)
    {
        $a = 'App\Models\\' . $model;
        if($model == 'Participant') {
            $total = Participant::withCount(['registration' => function($q) {
                $q->where('is_qualified', true);
            }])->count();
        } else {
            $total = $a::count();
        }

        return $total;
    }

    function announcement()
    {
        $announcement = Announcement::where('is_active', true)->get();

        return $announcement;
    }