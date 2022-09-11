<?php

namespace App\Http\Controllers\Main;

use App\Http\Controllers\Controller;
use App\Http\Requests\ClassRequest;
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
        $class = TrainingClass::all();

        $view = [
            'data' => view('main.class.render', compact('class'))->render(),
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
            $data = [
                'name' => $request->name,
                'category' => $request->category,
                'description' => $request->description,
            ];

            TrainingClass::create($data);

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

    public function edit($id) 
    {
        $class = TrainingClass::find($id);
        $category = ['Bar Class', 'Restaurant Class', 'Housekeeping', 'Kitchen/Culinary'];
        $view = [
            'data' => view('main.class.edit', compact('category', 'class'))->render()
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
            ];

            $class->update($data);

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

    public function delete($id)
    {
        try {
            $class = TrainingClass::find($id);
            $class->delete();
            return response()->json([
                'status' => 'success',
                'message' => 'Data berhasil dihapus',
                'title' => 'Berhasil'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 'error',
                'message' => $e->getMessage(),
                'title' => 'Gagal'
            ]);
        }
    }
}
