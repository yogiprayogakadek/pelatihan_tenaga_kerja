<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Assessor;
use App\Models\Attendance;
use App\Models\Participant;
use App\Models\TrainingClass;
use Illuminate\Http\Request;

class ClassController extends Controller
{
    public function index()
    {
        return view('main.class.index');
    }

    public function render()
    {
        if(auth()->user()->role == 'Admin') {
            $class = TrainingClass::all();
            $view = [
                'data' => view('main.class.render', compact('class'))->render(),
            ];
        } elseif (auth()->user()->role == 'Assessor') {
            $class = TrainingClass::where('assessor_id', auth()->user()->assessor->id)->get();
            $view = [
                'data' => view('main.class.render', compact('class'))->render(),
            ];
        } else {
            $participant = Participant::whereHas('payment', function($q) {
                $q->whereJsonContains('payment_data->transaction_status', 'settlement');
            })->with(['trainingClass' => function($q) {
                $q->where('id', auth()->user()->participant->class_id);
            }])->get();

            $view = [
                'data' => view('main.class.participant.participant', compact('participant'))->render(),
            ];
        }

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
            'data' => view('main.class.assessor.participant', compact('participant'))->render(),
        ];

        return response()->json($view);
    }

    public function attendance($class_id)
    {
        $participant = Participant::whereHas('payment', function($q) {
            $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        })->with(['attendance', 'registration' => function($query) {
            $query->where('is_qualified', true);
        }])->get();

        $attendance = Attendance::where('class_id', $class_id)->get();

        $view = [
            'data' => view('main.class.assessor.attendance', compact('participant', 'attendance'))->render(),
        ];

        return response()->json($view);
    }

    public function createAttendance($class_id, $meeting_number)
    {
        $participant = Participant::whereHas('payment', function($q) {
            $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        })->with(['attendance' => function($query) use ($class_id) {
            $query->where('class_id', $class_id);
        }])->get();
        // $participant = Participant::whereHas('registration', function($q) {
        //     $q->where('is_qualified', true);
        // })->with(['attendance' => function($query) use ($class_id) {
        //     $query->where('class_id', $class_id);
        // }])->get();

        $attendance = Attendance::where('class_id', $class_id)->where('meeting_number', $meeting_number)->get();

        $att = array();
        foreach($attendance as $attendance) {
            $att[$attendance->participant_id] = $attendance->is_attend;
        }

        $view = [
            'data' => view('main.class.assessor.create-attendance', compact('participant', 'att'))->render(),
        ];

        return response()->json($view);
    }

    public function participantAttendance()
    {
        $participant = Participant::with(['attendance'])->first();
        $attendance = Attendance::where('participant_id', auth()->user()->participant->id)->get();

        return view('main.class.participant.attendance', compact('attendance', 'participant'));
    }

    public function create()
    {
        $category = ['Bar Class', 'Restaurant Class', 'Housekeeping', 'Kitchen/Culinary'];
        $view = [
            'data' => view('main.class.create', compact('category'))->render(),
        ];

        return response()->json($view);
    }

    public function store(ClassRequest $request)
    {
        try {
            $data = [
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
            ];

            TrainingClass::create($data);

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

    public function edit($id) 
    {
        $class = TrainingClass::find($id);
        $assessor = Assessor::where('is_active', true)->pluck('name', 'id')->prepend('Pilih assessor', '')->toArray();
        // $assessor = Assessor::pluck('name', 'id')->prepend('Pilih assessor', '')->toArray();
        $category = ['Bar Class', 'Restaurant Class', 'Housekeeping', 'Kitchen/Culinary'];
        $view = [
            'data' => view('main.class.edit', compact('category', 'class', 'assessor'))->render()
        ];

        return response()->json($view);
    }

    public function update(ClassRequest $request)
    {
        try {
            $class = TrainingClass::find($request->id);
            $data = [
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
                'assessor_id' => $request->assessor,
            ];

            $class->update($data);

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

    public function delete($id)
    {
        try {
            $class = TrainingClass::find($id);
            $class->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data deleted successfully',
                'title' => 'Successfully'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'title' => 'Failed'
            ]);
        }
    }

    public function processAttendance(Request $request)
    {
        try {
            // dd($request->all());
            $data = Attendance::where('meeting_number', $request->meeting_number)->first();
            // dd($attendance == null ? 'Absence' : 'b');
            $participant = explode(',', $request->participant);
            $attendance = explode(',', $request->attendance);
            if($data != null) {
                // Attendance::where('meeting_number', $request->meeting_number)->delete();
                for($i = 1; $i < count($attendance); $i++) {
                    Attendance::where('class_id', $request->class_id)
                                ->where('participant_id', (int)$participant[$i])
                                ->where('meeting_number', $request->meeting_number)
                                ->update([
                                    'class_id' => $request->class_id,
                                    'participant_id' => (int)$participant[$i],
                                    'is_attend' => (int)$attendance[$i],
                                    'meeting_number' => $request->meeting_number,
                                ]);
                }
            } else {
                for($i = 1; $i < count($attendance); $i++) {
                    Attendance::create([
                        'class_id' => $request->class_id,
                        'participant_id' => (int)$participant[$i],
                        'is_attend' => (int)$attendance[$i],
                        'meeting_number' => $request->meeting_number,
                    ]);
                }
            }

            return response()->json([
                'status' => 'success',
                'message' => 'Absensi berhasil disimpan',
                'title' => 'Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                // 'message' => 'Absensi gagal disimpan',
                'message' => 'Something went wrong',
                'title' => 'Failed',
            ]);
        }
    }
}
