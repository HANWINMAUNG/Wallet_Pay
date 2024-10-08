<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminUserRequest extends FormRequest
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
        
            $id = $this->route('admin_user');
            return [
                'name' =>'required',
                'email' =>'required|email|unique:admin_users,email,' . $id,
                'phone' =>'required|min:9|max:11|unique:admin_users,phone,' . $id,
            ];
        
    }
}
