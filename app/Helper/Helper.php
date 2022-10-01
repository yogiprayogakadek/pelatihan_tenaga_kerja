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

    function convertDate($date, $printDate = false)
    {
        //explode / pecah tanggal berdasarkan tanda "-"
        $exp = explode("-", $date);

        $day = array(
            1 =>    'Senin',
            'Selasa',
            'Rabu',
            'Kamis',
            'Jumat',
            'Sabtu',
            'Minggu'
        );

        $month = array(
            1 =>   'Januari',
            'Februari',
            'Maret',
            'April',
            'Mei',
            'Juni',
            'Juli',
            'Agustus',
            'September',
            'Oktober',
            'November',
            'Desember'
        );
        // return $exp[2] . ' ' . $month[(int)$exp[1]] . ' ' . $exp[0];

        $split       = explode('-', $date);
        $convertDate = $split[2] . ' ' . $month[(int)$split[1]] . ' ' . $split[0];

        if ($printDate) {
            $num = date('N', strtotime($date));
            return $day[$num] . ', ' . $convertDate;
        }
        return $convertDate;
    }