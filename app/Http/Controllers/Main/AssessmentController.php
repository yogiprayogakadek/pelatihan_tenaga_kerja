<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssessmentRequest;
use App\Models\Assessment;
use App\Models\Participant;
use App\Models\TrainingClass;
use Illuminate\Http\Request;

class AssessmentController extends Controller
{
    public function index()
    {
        return view('main.assessment.index');
    }

    public function render()
    {
        if(auth()->user()->role->name == 'Admin') {
            $class = TrainingClass::all();
        } elseif(auth()->user()->role->name == 'Pengajar') {
            $class = TrainingClass::where('assessor_id', auth()->user()->assessor->id)->get();
        }

        $view = [
            'data' => view('main.assessment.render', compact('class'))->render(),
        ];

        return response()->json($view);
    }

    public function participant($class_id)
    {
        $participant = Participant::whereHas('payment', function($q) {
            $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        })->with(['registration' => function($query) {
            $query->where('is_qualified', true);
        }])->where('class_id', $class_id)->get();

        $view = [
            'data' => view('main.assessment.participant', compact('participant'))->render(),
        ];

        return response()->json($view);
    }

    public function edit($participant_id)
    {
        $assessment = Assessment::where('participant_id', $participant_id)->first();

        return response()->json($assessment);
    }

    public function store(AssessmentRequest $request)
    {
        try {
            Assessment::updateOrCreate([
                'participant_id' => $request->participant_id
            ],
            [
                'participant_id' => $request->participant_id,
                'speaking' => $request->speaking,
                'writing' => $request->writing,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil tersimpan',
                'title' => 'Berhasil'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Data gagal tersimpan',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
