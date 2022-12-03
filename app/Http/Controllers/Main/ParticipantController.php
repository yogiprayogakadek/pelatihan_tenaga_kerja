<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Models\Attendance;
use App\Models\Participant;
use App\Models\User;
use Illuminate\Http\Request;

class ParticipantController extends Controller
{
    public function index()
    {
        return view('main.participant.index');
    }

    public function render()
    {
        $participant = Participant::all();
        $view = [
            'data' => view('main.participant.render', compact('participant'))->render()
        ];
        return response()->json($view);
    }

    public function edit($id) 
    {
        $participant = Participant::with('user')->find($id);
        $view = [
            'data' => view('main.participant.edit', compact('participant'))->render()
        ];

        return response()->json($view);
    }

    public function upload(Request $request)
    {
        try {
            $participant = Participant::find($request->participant_id);

            // if($request->hasFile('file')) {
            //get filename with extension
            $filenamewithextension = $request->file('file')->getClientOriginalName();

            //get file extension
            $extension = $request->file('file')->getClientOriginalExtension();

            //filename to store
            $filenametostore = $participant->name . '-' . $request->document . '-' . time() . '.' . $extension;
            $save_path = 'assets/uploads/media/documents';

            if(json_decode($participant->documents, true)[$request->document] != "empty") {
                unlink(json_decode($participant->documents, true)[$request->document]);
            }

            if (!file_exists($save_path)) {
                mkdir($save_path, 666, true);
            }
            
            $request->file('file')->move($save_path, $filenametostore);

            $newData = json_decode($participant->documents, true);
            $newData[$request->document] = $save_path . '/' . $filenametostore;
            
            $participant->documents = json_encode($newData);
            $participant->save();

            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully',
                'title' => 'Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'title' => 'Failed'
            ]);
        }
    }

    public function update(Request $request)
    {
        try {
            $user = User::find($request->user_id);
            $participant = Participant::where('user_id', $request->user_id)->first();
            // dd($user);
            // dd($participant->registration);
            $user->update([
                'status' => $request->isActive
            ]);
            $participant->registration->update([
                'is_qualified' => $request->status,
                'note' => $request->note
            ]);


            // if($request->status == 1) {
            //     $attendance = Attendance::firstOrNew(
            //         [
            //             'class_id' => $participant->class_id,
            //             'participant_id' => $participant->id,
            //             'meeting_number' => 1,
            //             'is_attend' => false
            //         ],
            //     );
            //     $attendance->save();
            // } else {
            //     $attendance = Attendance::where('participant_id', $participant->id)->first();
            //     if($attendance !== null) {
            //         $attendance->delete();
            //     }
            // }

            return response()->json([
                'status' => 'success',
                'message' => 'Data saved successfully',
                'title' => 'Successfully',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'title' => 'Failed'
            ]);
        }
    }

    public function document() 
    {
        $participant = Participant::with('user')->find(auth()->user()->participant->id);

        return view('main.participant.document', compact('participant'));
    }
}
