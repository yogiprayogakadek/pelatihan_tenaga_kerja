<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AssessorRequest;
use App\Models\Assessor;
use App\Models\Role;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Image;

class AssessorController extends Controller
{
    public function index()
    {
        return view('main.assessor.index');
    }

    public function render()
    {
        $assessor = Assessor::all();

        $view = [
            'data' => view('main.assessor.render', compact('assessor'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {

        $view = [
            'data' => view('main.assessor.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(AssessorRequest $request)
    {
        try {
            $role = Role::where('name', 'Pengajar')->first();

            $userData = [
                'username' => $request->username,
                'password' => bcrypt($request->password),
                'role_id' => $role->id
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
            ];

            Assessor::create($data);

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
        $assessor = Assessor::with('user')->find($id);
        $view = [
            'data' => view('main.assessor.edit', compact('assessor'))->render()
        ];

        return response()->json($view);
    }

    public function update(AssessorRequest $request)
    {
        try {
            $user = User::find($request->user_id);
            $userData = [
                'username' => $request->username,
                // 'password' => bcrypt($request->password),
            ];

            if($request->has('current_password') && $request->current_password != '') {
                if($request->new_password == '' || $request->confirmation_password == '') {
                    return response()->json([
                        'status' => 'error',
                        'message' => 'You must enter the password',
                        'title' => 'Failed',
                    ]);
                } else {
                    if(!Hash::check($request->current_password, $user->password)) {
                        return response()->json([
                            'status' => 'error',
                            'message' => 'Old password doesnt match',
                            'title' => 'Failed'
                        ]);
                    } else {
                        $userData['password'] = Hash::make($request->new_password);
                    }
                }
            }

            if($request->hasFile('image')) {
                unlink($user->image);
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

            $user->update($userData);

            $data = [
                'name' => $request->name,
                'gender' => $request->gender,
                'phone' => $request->phone,
                'address' => $request->address,
            ];

            Assessor::where('user_id', $request->user_id)->update($data);

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
            $assessor = Assessor::find($id);
            unlink($assessor->user->image);
            User::find($assessor->user_id)->delete();
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
}
