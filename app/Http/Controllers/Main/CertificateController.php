<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use Illuminate\Http\Request;
use PDF;

class CertificateController extends Controller
{
    public function index() 
    {
        $participant = Participant::with(['assessment'])->where('id', auth()->user()->participant->id)->first();
        $assessment = 0;
        if($participant->assessment != null) {
            $assessment = ($participant->assessment->speaking + $participant->assessment->writing)/2;
        }
        return view('main.certificate.index')->with([
            'participant' => $participant,
            'assessment' => $assessment
        ]);
    }

    public function generateCertificate()
    {
        $participant = Participant::with(['assessment'])->where('id', auth()->user()->participant->id)->first();
        $assessment = 0;
        if($participant->assessment != null) {
            $assessment = ($participant->assessment->speaking + $participant->assessment->writing)/2;
        }
        $date = convertDate(date('Y-m-d'));

        $pdf = PDF::loadview('main.certificate.download', ['participant' => $participant, 'assessment' => $assessment, 'date' => $date]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('certificate-'.$participant->name.'-'.time().'.pdf');
    }
}
