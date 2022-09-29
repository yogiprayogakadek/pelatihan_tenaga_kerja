<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\AnnouncementRequest;
use App\Models\Announcement;
use Illuminate\Http\Request;

class AnnouncementController extends Controller
{
    public function index()
    {
        return view('main.announcement.index');
    }

    public function render()
    {
        $announcement = Announcement::all();

        $view = [
            'data' => view('main.announcement.render', compact('announcement'))->render(),
        ];

        return response()->json($view);
    }

    public function create()
    {
        $view = [
            'data' => view('main.announcement.create')->render(),
        ];

        return response()->json($view);
    }

    public function store(AnnouncementRequest $request)
    {
        try {
            $data = [
                'title' => $request->title,
                'description' => $request->description,
            ];

            Announcement::create($data);

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
        $announcement = Announcement::find($id);
        $view = [
            'data' => view('main.announcement.edit', compact('announcement'))->render()
        ];

        return response()->json($view);
    }

    public function update(AnnouncementRequest $request)
    {
        try {
            $announcement = Announcement::find($request->id);
            $data = [
                'title' => $request->title,
                'description' => $request->description,
                'is_active' => $request->status,
            ];

            $announcement->update($data);

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
            $announcement = Announcement::find($id);
            $announcement->delete();
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

    public function detail($id) 
    {
        $announcement = Announcement::find($id);
        $data = [
            'title' => $announcement->title,
            'more' => $announcement->description,
            'less' => strlen($announcement->description > 50) ? substr($announcement->description,0,50) . "..." : $announcement->description
        ];
        return response()->json($data);
    }
}
