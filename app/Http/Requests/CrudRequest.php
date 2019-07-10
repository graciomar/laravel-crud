<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;
use App\Http\Requests\Auth;
use Illuminate\Foundation\Http\FormRequest;

class CrudRequest extends FormRequest
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

    public function messages()
    {
        return [
            'name.required'=>'The name is required.',
            'name.max'=>'Name must be up to 255 characters.',
            'email.required'=>'The name is required.',
            'email.email'=>'Email invalid.',
            'email.max'=>'Email must be up to 255 characters.'

        ];
    }

    /**
    * Get the validation rules that apply to the request.
    *
    * @return array
    */
    public function rules()
    {
        return [
            'name'=>'required|max:255',
            'email'=>'required|email|max:255',
        ];
    }
}
