<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StudentRegRequest extends FormRequest
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
            'name'=>'required',
            'father_name'=>'required',
            'mother_name'=>'required',
            'mobile'=>'required',
            'address'=>'required',
            'gender'=>'required',
            'religion'=>'required',
            'date_of_birth'=>'required',
            'discount'=>'nullable',
            'year_id'=>'required',
            'class_id'=>'required',
            'group_id'=>'required',
            'shift_id'=>'required',
            'image'=>'required',
        ];
    }
}
