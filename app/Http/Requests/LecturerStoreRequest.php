<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class LecturerStoreRequest extends FormRequest{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(){
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(){
        return [
            'name' => 'required|string|max:50|min:3',
            'email' => 'required|email|max:50|min:5',
            'phone_number' => 'required|min:7|max:14|regex:/^[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\0-9]*$/i'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(){
        return [
            'email.required' => 'Email is required!',
            'name.required' => 'Name is required!',
            'phone_number.required' => 'Password is required!'
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     *
     * @return array
     */
    protected function failedValidation(Validator $validator){
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors(),
            'status' => 'fail'
        ], 400));
    }
}
