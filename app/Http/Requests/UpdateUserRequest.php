<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
            $id = $this->route('user');
            return [
                'name' =>'required',
                'email' =>'required|email|unique:users,email,' . $id,
                'phone' =>'required|min:9|max:11|unique:users,phone,' . $id,
            ];
    }
}
