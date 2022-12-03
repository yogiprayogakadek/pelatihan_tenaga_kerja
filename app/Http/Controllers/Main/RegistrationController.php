<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\RegistrationRequest;
use App\Models\Participant;
use App\Models\ParticipantClass;
use App\Models\Registration;
use App\Models\Role;
use App\Models\TrainingClass;
use App\Models\User;
use Illuminate\Http\Request;
use Image;

class RegistrationController extends Controller
{
    public function index()
    {
        // $class = TrainingClass::pluck('name', 'id')->prepend('Pilih kelas...', '')->toArray();
        $class = TrainingClass::where('status', true)->get();
        return view('auth.registration', compact('class'));
    }

    public function store(RegistrationRequest $request)
    {
        try {
            // $role = Role::where('name', 'Participant')->first();

            $userData = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                // 'role_id' => $role->id
                'role' => 'Participant'
            ];

            if($request->hasFile('image')) {
                //get filename with extension
                $filenamewithextension = $request->file('image')->getClientOriginalName();

                //get file extension
                $extension = $request->file('image')->getClientOriginalExtension();

                //filename to store
                $filenametostore = $request->name . '-' . time() . '.' . $extension;
                $save_path = 'assets/uploads/media/users';

                if (!file_exists($save_path)) {
                    mkdir($save_path, 666, true);
                }
                $img = Image::make($request->file('image')->getRealPath());
                $img->resize(512, 512);
                $img->save($save_path . '/' . $filenametostore);

                $userData['image'] = $save_path . '/' . $filenametostore;
            }

            $user = User::create($userData);

            $data = [
                'user_id' => $user->id,
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
                'date_of_birth' => $request->date_of_birth,
                'place_of_birth' => $request->place_of_birth,
                // 'class_id' => $request->class,
            ];

            $documents = [
                'cv' => "empty",
                'sertifikat_pengalaman_kerja' => "empty",
                'foto' => "empty",
                // 'ijazah_sma' => "empty", //ijazah sma atau smk
                // 'ijazah_pt' => "empty", //ijazah perguruan tinggi
                'ijazah_terakhir' => "empty", //kartu keluarga
                'kk' => "empty", //kartu keluarga
                'ktp' => "empty",
                'akte_lahir' => "empty"
            ];

            $data['documents'] = json_encode($documents);

            $participant = Participant::create($data);

            // save to participant class
            ParticipantClass::create([
                'participant_id' => $participant->id,
                'class_id' => $request->class
            ]);
            
            Registration::create([
                'participant_id' => $participant->id,
                // 'class_id' => $request->class,
                'registration_date' => date('Y-m-d'),
                'is_qualified' => false,
                'note' => null
            ]);

            return redirect()->route('login')->with([
                'message' => 'Registration successfully!',
                'status' => 'success',
            ]);
        } catch (\Exception $e) {
            return redirect()->back()->with([
                // 'message' => 'Pendaftaran gagal',
                'message' => 'Something went wrong',
                'status' => 'error',
            ]);
        }
    }
}
