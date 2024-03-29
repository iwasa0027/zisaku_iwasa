<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MypageData extends FormRequest
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
            'image'=>'required|image|mimes:jpeg,png,jpg,gif',
            'profile'=>'max:300',
            'name'=>'required|max:50',
             'email'=>'required|email|max:100',
        ];
    }
}
