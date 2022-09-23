<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AssessmentRequest extends FormRequest
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
            'speaking' => 'required|numeric',
            'writing' => 'required|numeric',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute harus diisi',
            'numeric' => ':attribute hanya mengandung angka'
        ];
    }

    public function attributes()
    {
        return [
            'speaking' => 'Speaking',
            'writing' => 'Writing'
        ];
    }
}
