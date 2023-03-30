<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateData extends FormRequest
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
            'title'=>'required|max:50',
            'image_path'=>'required|image|mimes:jpeg,png,jpg,gif',
            'feelings'=>'required|max:500',
            'tag_name'=>'max:100',
            'pref'=>'required',
          
           
        ];
    }
}
