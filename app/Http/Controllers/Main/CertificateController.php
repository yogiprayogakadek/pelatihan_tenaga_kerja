<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Participant;
use App\Models\ParticipantClass;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use PDF;

class CertificateController extends Controller
{
    public function index() 
    {
        return view('main.certificate.index');
    }

    public function render() 
    {
        // $participant = Participant::with(['assessment'])->where('id', auth()->user()->participant->id)->first();
        // $assessment = 0;
        // if($participant->assessment != null) {
        //     $assessment = ($participant->assessment->speaking + $participant->assessment->writing)/2;
        // }
        // return view('main.certificate.index')->with([
        //     'participant' => $participant,
        //     'assessment' => $assessment
        // ]);

        $class_id = Payment::where('participant_id', auth()->user()->participant->id)->pluck('class_id')->toArray();
        $participantClass = ParticipantClass::with('trainingClass')->where('participant_id', auth()->user()->participant->id)->whereIn('class_id', $class_id)->get();

        $view = [
            'data' => view('main.certificate.render', compact('participantClass'))->render(),
        ];

        return response()->json($view);
    }

    public function generateCertificate($class_id)
    {
        // $participant = Participant::with(['assessment' => function($query) use($class_id) {
        //     $query->where('class_id', $class_id);
        // }])->where('id', auth()->user()->participant->id)->first();
        $participant = DB::table('participants')
                        ->select('participants.*', 'assessments.writing', 'assessments.speaking', 'classes.name as class_name', 'classes.category as category', 'assessors.name as assessor_name')
                        ->join('assessments', 'participants.id', 'assessments.participant_id')
                        ->join('classes', 'assessments.class_id', 'classes.id')
                        ->join('assessors', 'classes.assessor_id', 'assessors.id')
                        ->where('assessments.class_id', $class_id)
                        ->get();
        $user = User::where('id', $participant[0]->user_id)->first();
        // dd($participant[0]);
        // $assessment = 0;
        // if($participant->assessment != null) {
        //     $assessment = ($participant->assessment->speaking + $participant->assessment->writing)/2;
        // }
        // $date = convertDate(date('Y-m-d'));

        // $pdf = PDF::loadview('main.certificate.download', ['participant' => $participant, 'assessment' => $assessment, 'date' => $date]);
        // $pdf->setPaper('A4', 'landscape');
        // return $pdf->stream('certificate-'.$participant->name.'-'.time().'.pdf');

        $assessment = 0;
        if($participant[0]->writing != null) {
            $assessment = ($participant[0]->speaking + $participant[0]->writing)/2;
        }
        $date = convertDate(date('Y-m-d'));

        $pdf = PDF::loadview('main.certificate.download', [
            'participant' => $participant[0], 
            'assessment' => $assessment, 
            'date' => $date,
            'participant_image' => $user->image,
        ]);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->stream('certificate-'.$participant[0]->name.'-'.time().'.pdf');
    }
}
