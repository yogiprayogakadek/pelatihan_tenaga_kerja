<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class ClassRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $rules = [
            'category' => 'required',
            'name' => 'required',
            'description' => 'required',
        ];

        if (!Request::instance()->has('id')) {
            $rules += [
                'assessor' => 'nullable',
                'status' => 'nullable',
            ];
        } else {
            $rules += [
                'assessor' => 'required',
                'status' => 'required',
            ];
        }
        
        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
        ];
    }

    public function attributes()
    {
        return [
            'category' => 'Kategori',
            'name' => 'Nama kelas',
            'description' => 'Deskripsi',
            'assessor' => 'Assessor'
        ];
    }
}
