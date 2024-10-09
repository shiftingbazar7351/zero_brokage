<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;


class UserRequest extends FormRequest
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
        $method = strtolower($this->method());
        $user_id = $this->route()->user;

        $rules = [];
        switch ($method) {
            case 'post':
                $rules = [
                    'first_name'=>'required|max:15',
                    'last_name'=>'required|max:20',
                    'password' => [
                                'required',
                                'string',
                                'confirmed',
                                'min:8',
                                'regex:/^(?=.*[a-zA-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]+$/',
                            ],
                    'email' => 'required|max:191|email:rfc,dns|unique:users',
                    'user_role'=>'required',
                ];
                break;
            case 'patch':
                $rules = [
                    'first_name'=>'required|max:15',
                    'last_name'=>'required|max:20',
                    'email' => 'required|max:191|email:rfc,dns|unique:users,email,'.$user_id,
                    'user_role'=>'sometimes',
                ];
                break;

        }

        return $rules;
    }

    public function messages()
    {
        return [
            'password.regex' => 'The password must be at least 8 characters long and contain at least one letter, one number, and one special character (@$!%*?&).',
        ];
    }

     /**
     * @param Validator $validator
     */
    protected function failedValidation(Validator $validator){
        $data = [
            'status' => true,
            'message' => $validator->errors()->first(),
            'all_message' =>  $validator->errors()
        ];

        if ($this->ajax()) {
            throw new HttpResponseException(response()->json($data,422));
        } else {
            throw new HttpResponseException(redirect()->back()->withInput()->with('errors', $validator->errors()));
        }
    }


}
