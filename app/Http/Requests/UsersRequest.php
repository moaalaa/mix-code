<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MixCode\User;

class UsersRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->check() && auth()->user()->isAdmin();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
 
        $basic_fields = [
            'full_name'    => ['required', 'string', 'max:191'],
            'email'         => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password'      => ['required', 'string', 'min:6'],
            'phone'         => ['required'],
            'type'          => ['required', Rule::in([User::ADMIN_TYPE,  User::CUSTOMER_TYPE])],
            'status'        => ['required', Rule::in([User::ACTIVE_STATUS, User::PENDING_STATUS, User::INACTIVE_STATUS])],
        ];

 

        $files_fields = [
            'logo'                  => ['nullable' , 'image', 'mimes:jpg,jpeg,png'],
            ];

        $rules = array_merge($basic_fields,$files_fields);

        if ($this->isMethod('PATCH')) {
            $id = $this->route()->parameter('user')->getKey();
            $rules['email'] =  ['required', 'email', 'max:191', Rule::unique('users')->ignore($id)];
            unset($rules['password']); // Remove Password It Has It's Own Function

            $files_fields = [
                'logo'                  => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
     
            ];

            $rules = array_merge($rules, $files_fields);
        }

        return $rules;
    }
}
