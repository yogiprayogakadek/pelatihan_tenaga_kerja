<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssessmentRequest;
use App\Models\Assessment;
use App\Models\Participant;
use App\Models\ParticipantClass;
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
        if(auth()->user()->role == 'Admin') {
            $class = TrainingClass::all();
        } elseif(auth()->user()->role == 'Assessor') {
            $class = TrainingClass::where('assessor_id', auth()->user()->assessor->id)->get();
        }

        $view = [
            'data' => view('main.assessment.render', compact('class'))->render(),
        ];

        return response()->json($view);
    }

    public function participant($class_id)
    {
        $participantClass = ParticipantClass::where('class_id', $class_id)->pluck('participant_id')->toArray();
        $participant = Participant::whereHas('payment', function($q) {
            $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        })->with(['registration' => function($query) {
            $query->where('is_qualified', true);
        }])->whereIn('id', $participantClass)->get();

        $view = [
            'data' => view('main.assessment.participant', compact('participant'))->render(),
        ];

        return response()->json($view);
    }

    public function edit($class_id, $participant_id)
    {
        $assessment = Assessment::where('class_id', $class_id)->where('participant_id', $participant_id)->first();

        return response()->json($assessment);
    }

    public function store(AssessmentRequest $request)
    {
        try {
            if($request->speaking < 10 || $request->writing < 10) {
                return response()->json([
                    'status' => 'info',
                    'message' => 'Minimum value above 10',
                    'title' => 'info'
                ]);
            }
            Assessment::updateOrCreate([
                'participant_id' => $request->participant_id,
                'class_id' => $request->training_class_id
            ],
            [
                'participant_id' => $request->participant_id,
                'class_id' => $request->training_class_id,
                'speaking' => $request->speaking,
                'writing' => $request->writing,
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully',
                'title' => 'Successfully'
            ]);

        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Something went wrong',
                'message' => 'Something went wrong',
                'title' => 'Failed'
            ]);
        }
    }
}
