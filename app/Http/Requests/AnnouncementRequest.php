<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class AnnouncementRequest extends FormRequest
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
            'title' => 'required',
            'description' => 'required',
        ];

        if(!Request::instance()->has('id')) {
            $rules += ['status' => 'nullable'];
        } else {
            $rules += ['status' => 'required'];
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
            'title' => 'Judul',
            'description' => 'Deskripsi',
            'status' => 'Status',
        ];
    }
}
