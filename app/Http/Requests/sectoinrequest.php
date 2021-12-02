<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class sectoinrequest extends FormRequest
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
            'section_name' => 'required|max:200|unique:sections,section_name,'.$this->id,
            'section_description' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'section_name.required' => 'يجب ادخال حقل اسم القسم',
            'section_name.unique' => 'هذا القسم موجود بالفعل',
            'section_name.max' => 'لا يجب ان يزيد عدد حروف القسم عن 200 حرف',
            'section_description.required' => 'يجب ادخال حقل الوصف'
        ];
    }
}
