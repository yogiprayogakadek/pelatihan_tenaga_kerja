<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegistrationRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        $rules =  [
            'class' => 'required',
            'name' => 'required',
            'gender' => 'required',
            'phone' => 'required',
            'address' => 'required',
            'username' => 'required',
            'date_of_birth' => 'required|date',
            'place_of_birth' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'password' => 'required|min:8',
        ];

        return $rules;
    }

    public function messages()
    {
        return [
            'required' => ':attribute tidak boleh kosong',
            'min' => ':attribute minimal :min karakter',
            'max' => ':attribute maksimal :max karakter',
            'unique' => ':attribute sudah digunakan',
            'mimes' => ':attribute harus berupa file :values',
            'image' => ':attribute harus berupa file gambar',
            'same' => ':attribute tidak sama dengan :other',
            'date' => ':attribute harus berupa tanggal',
            'numeric' => ':attribute harus berupa angka',
            'regex' => ':attribute panjang 12 karakter',
        ];
    }

    public function attributes()
    {
        return [
            'class' => 'Kelas',
            'name' => 'Nama',
            'gender' => 'Jenis kelamin',
            'phone' => 'No. telp',
            'address' => 'Alamat',
            'username' => 'Username',
            'password' => 'Password',
            'date_of_birth' => 'Tanggal lahir',
            'place_of_birth' => 'Tempat lahir',
            'image' => 'Foto'
        ];
    }
}
