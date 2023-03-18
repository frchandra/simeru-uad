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
            'data' => 'present|required|array',
            'data.*.name' => 'present|required|string|max:50|min:3',
            'data.*.email' => 'email|max:50|min:5',
            'data.*.phone_number' => 'min:7|max:14|regex:/^[(]*[+]*[(]{0,1}[0-9]{1,4}[)]{0,1}[-\s\.\0-9]*$/i'
        ];
    }

    /**
     * Custom message for validation
     *
     * @return array
     */
    public function messages(){
        return [
            'name.required' => 'Name is required!',
        ];
    }

    /**
     * Get the error messages for the defined validation rules.*
     *
     * @return array
     */
    protected function failedValidation(Validator $validator){
        $errors = $validator->errors()->toArray();
        $errorsMessage = array();

        foreach ($errors as $error) {
            array_push($errorsMessage, $error[0]);
        }

        throw new HttpResponseException(response()->json([
            'errors' => $errorsMessage,
            'status' => 'fail'
        ], 400));
    }
}
