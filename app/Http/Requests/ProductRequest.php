<?php

namespace APSMeetup\Http\Requests;

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
        $id = '';

        if ($this->isMethod('PUT') || $this->isMethod('PATCH')) {
            $id = $this->product->id;
        }

        return [
            'name' => "required|unique:products,name,{$id},id",
            'description' => 'required|max:100',
            'price' => 'required'
        ];
    }
}
