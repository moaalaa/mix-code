<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MixCode\User;

class ApiRegisterRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->guest();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
 
        $basic_fields = [
            'full_name'     => ['required', 'string', 'max:191'],
            'email'         => [ 'string', 'email', 'max:191', 'unique:users'],
            'password'      => ['required', 'string'],
            'phone'         => ['required','unique:users'],
            'type'          => ['required', Rule::in([User::CUSTOMER_TYPE])],
        ];



        // $files_fields = [
        //     'logo'                  => ['nullable', Rule::requiredIf($isCompanyType), 'image', 'mimes:jpg,jpeg,png'],
        // ];

        $rules = array_merge($basic_fields);

        return $rules;
    }
}
