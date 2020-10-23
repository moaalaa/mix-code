<?php

namespace MixCode\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

use MixCode\Company;

class CompaniesRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->isAllowed();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'en_name'       => ['required', 'string', 'max:191'],
            'ar_name'       => ['required', 'string', 'max:191'],
            'email'         => ['required', 'string', 'email', 'unique:companies'],
            'phone'         => ['required'],

            'images'        => ['required'],
            'images.*'      => ['required', 'image', 'mimes:jpeg,jpg,png'],
        ];

        if ($this->isMethod('PATCH')) {
            $rules['images']    = ['nullable', 'min:1'];
            $rules['images.*']  = ['nullable', 'image', 'mimes:jpeg,jpg,png'];

            $id = $this->route()->parameter('company')->getKey();
             $rules['email'] =  ['required', 'email', 'max:191', Rule::unique('companies')->ignore($id)];

            $rules = array_merge($rules);
        }
    
        return $rules;
        
    }
}
