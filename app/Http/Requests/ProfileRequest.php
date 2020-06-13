<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MixCode\User;

class ProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $id = auth()->id();
            
        $isCompanyType = auth()->user()->type === User::USER_TYPES;

        $basic_fields = [
            'full_name'     => ['required', 'string', 'max:191'],
            'email'         => ['sometimes','required', 'email', 'max:191', Rule::unique('users')->ignore($id)],
            'phone'         => ['sometimes','required'],
        ];
 

        $rules = array_merge($basic_fields);

        return $rules;
    }
}