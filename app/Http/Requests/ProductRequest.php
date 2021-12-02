<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
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
            'product_name' => 'required|string',
            'product_description' => 'max:200',
            'section_id' => 'required|exists:sections,id',
        ];
    }


    public function messages()
    {
        return [
            'product_name.required' => 'حقل اسم المنتج مطلوب',
            'section_id.required' => 'حقل اسم القسم مطلوب',
        ];
    }
}
