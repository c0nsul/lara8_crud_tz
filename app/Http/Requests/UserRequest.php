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
        $rule = isset($this->user->id) ? ",".$this->user->id : null;
        return [
            'name' => 'required|string|min:3|max:50',
            'email' => "required|email|min:3|max:150|unique:users,email".$rule,
        ];
    }
}
