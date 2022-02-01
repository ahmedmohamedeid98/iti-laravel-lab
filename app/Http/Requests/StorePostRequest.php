<?php

namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StorePostRequest extends FormRequest
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
       
        $rules = [
            'description' => ['required','min:10'],
            'post_creator'=> ['required', Rule::exists('users', 'id')]
        ];
        if($this->old_title != $this->title) {
            $rules['title'] = ['required','min:3', 'unique:posts'];
        }

        if(isset($this->image)) {
            $rules['image'] = ['mimes:jpg,png', 'max:2048'];
        }
        
        return $rules;
    }


    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'title.required' => 'A title is required',
            'description.required' => 'A description is required',
        ];
    }
}
