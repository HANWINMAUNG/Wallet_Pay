<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminUserRequest extends FormRequest
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
        if($this->method() == 'PATCH'){
            return [
                'name' =>'required',
                'email' =>'required',
                 'phone' =>'required',
                 'password' =>'confirmed',
            ];
        }else{
                return [
                    'name' =>'required',
                    'email' =>'required|email|unique:admin_users,email',
                    'phone' =>'required',
                    'password' => 'required|min:6|max:20'
                ];
    }
    }
}
