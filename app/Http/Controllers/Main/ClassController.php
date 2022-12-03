<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
use App\Models\Assessor;
use App\Models\Attendance;
use App\Models\Participant;
use App\Models\ParticipantClass;
use App\Models\Payment;
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
            // $participant = Participant::whereHas('payment', function($q) {
            //     $q->whereJsonContains('payment_data->transaction_status', 'settlement');
            // })->with(['trainingClass' => function($q) {
            //     $q->where('id', auth()->user()->participant->class_id);
            // }])->get();

            // $view = [
            //     'data' => view('main.class.participant.participant', compact('participant'))->render(),
            // ];

            $class_id = Payment::where('participant_id', auth()->user()->participant->id)->pluck('class_id')->toArray();
            $participantClass = ParticipantClass::with('trainingClass')->whereIn('class_id', $class_id)->where('participant_id', auth()->user()->participant->id)->get();

            $view = [
                'data' => view('main.class.participant.render', compact('participantClass'))->render(),
            ];
        }

        return response()->json($view);
    }

    public function participant($class_id)
    {
        // $participant = Participant::whereHas('payment', function($q) {
        //     $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        // })->with(['registration' => function($query) {
        //     $query->where('is_qualified', true);
        // }])->where('class_id', $class_id)->get();
        // $view = [
        //     'data' => view('main.class.assessor.participant', compact('participant'))->render(),
        // ];

        $participantClass = ParticipantClass::where('class_id', $class_id)->pluck('participant_id')->toArray();
        $participant = Participant::whereHas('payment', function($q) {
            $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        })->with(['registration' => function($query) {
            $query->where('is_qualified', true);
        }])->whereIn('id', $participantClass)->get();

        if(auth()->user()->role == 'Participant') {
            $view = [
                'data' => view('main.class.assessor.participant', compact('participant'))->render(),
            ];
        } else {
            $view = [
                'data' => view('main.class.participant.participant', compact('participant'))->render(),
            ];
        }

        return response()->json($view);
    }

    public function attendance($class_id)
    {
        $participantClass = ParticipantClass::where('class_id', $class_id)->pluck('participant_id')->toArray();

        $participant = Participant::whereHas('payment', function($q) {
            $q->whereJsonContains('payment_data->transaction_status', 'settlement');
        })->with(['registration' => function($query) {
            $query->where('is_qualified', true);
        }, 'attendance' => function($q) use ($class_id) {
            $q->where('class_id', $class_id);
        }])->whereIn('id', $participantClass)->get();
        // dd($participant);
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

    // ATTENDANCE
    public function participantIndexAttendance() 
    {
        return view('main.class.participant.attendance.index');
    }

    public function participantRenderAttendance()
    {
        // $participant = Participant::with(['attendance'])->first();
        // $attendance = Attendance::where('participant_id', auth()->user()->participant->id)->get();

        // return view('main.class.participant.attendance', compact('attendance', 'participant'));

        $class_id = Payment::where('participant_id', auth()->user()->participant->id)->pluck('class_id')->toArray();
        $participantClass = ParticipantClass::with('trainingClass')->whereIn('class_id', $class_id)->get();

        $view = [
            'data' => view('main.class.participant.attendance.render', compact('participantClass'))->render(),
        ];

        return response()->json($view);
    }

    public function participantAttendance($class_id)
    {
        $participant = Participant::with(['attendance' => function($query) use($class_id) {
            $query->where('class_id', $class_id);
        }])->first();
        $attendance = Attendance::where('participant_id', auth()->user()->participant->id)->where('class_id', $class_id)->get();
        $view = [
            'data' => view('main.class.participant.attendance.attendance', compact('attendance', 'participant'))->render()
        ];

        return response()->json($view);
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
            $cat = $request->category;
            if($cat == "Bar Class") {
                $code = 'BR-' . date('Y');
            } else if ($cat == "Restaurant Class") {
                $code = 'RC-' . date('Y');
            } else if ($cat == "Housekeeping") {
                $code = 'HK-' . date('Y');
            } else if ($cat == "Kitchen/Culinary") {
                $code = 'KT-' . date('Y');
            }

            $data = [
                'code' => $code,
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
            $cat = $request->category;
            if($cat == "Bar Class") {
                $code = 'BR-' . date('Y');
            } else if ($cat == "Restaurant Class") {
                $code = 'RC-' . date('Y');
            } else if ($cat == "Housekeeping") {
                $code = 'HK-' . date('Y');
            } else if ($cat == "Kitchen/Culinary") {
                $code = 'KT-' . date('Y');
            }

            $class = TrainingClass::find($request->id);
            $data = [
                'code' => $code,
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
                'assessor_id' => $request->assessor,
                'status' => $request->status,
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
                'message' => 'Attendance saved!',
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


    // PARTICIPANT >> CLASS
    public function add() {
        $class = TrainingClass::all();
        $alreadyRegis = ParticipantClass::where('participant_id', auth()->user()->participant->id)->pluck('class_id')->toArray();
        $view = [
            'data' => view('main.class.participant.create-class', compact('class', 'alreadyRegis'))->render(),
        ];

        return response()->json($view);
    }

    public function join($class_id) {
        try {
            ParticipantClass::create([
                'participant_id' => auth()->user()->participant->id,
                'class_id' => $class_id
            ]);

            return response()->json([
                'status' => 'success',
                'message' => 'Success to join this class, please pay for the payment!',
                'title' => 'Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong!',
                'title' => 'Failed',
            ]);
        }
    }
}
