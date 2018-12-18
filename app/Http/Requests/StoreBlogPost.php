<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBlogPost extends FormRequest
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
        return [
                'login' => 'required|min:4|unique:users',
                'password' => 'required|same:password2',
                'email' => 'required|unique:users',
                'name' => 'required|alpha',
                'lastname' => 'required|alpha',
                'born' => 'required',
                'city' => 'required|alpha',
                'telefon' => 'required|int',
                'voivodeship' => 'required|alpha',
                'file' => 'mimes:jpeg,bmp,png,jpg,gif',
        ];
    }
}
