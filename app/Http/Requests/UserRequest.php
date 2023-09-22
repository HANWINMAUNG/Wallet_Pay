<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
        if($this->method() == 'PATCH'){
            $id = $this->route('user');
            return [
                'name' =>'required',
                'email' =>'required|email|unique:users,email,' . $id,
                 'phone' =>'required|unique:users,phone,' . $id,
            ];
        }else{
                return [
                    'name' =>'required',
                    'email' =>'required|email|unique:users,email',
                    'phone' =>'required|unique:users,phone',
                    'password' => 'required|min:6|max:20'
                ];
    }
    }
}
