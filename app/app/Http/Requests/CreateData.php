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
            'title'=>'required',
            'image_path'=>'required|image|mimes:jpeg,png,jpg,gif',
            'feelings'=>'required|max:1000',
            
            'tag_name'=>'max:100',

            'image'=>'image|mimes:jpeg,png,jpg,gif',
           
        ];
    }
}
