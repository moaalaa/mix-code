<?php

namespace MixCode\Http\Controllers\Auth;

use MixCode\User;
use MixCode\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Validation\Rule;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = '/home';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        $isCompanyType = $data['type'] === User::COMPANY_TYPE;

        $basic_fields = [
            'username'      => ['required', 'string', 'max:191'],
            'full_name'     => ['required', 'string', 'max:191'],
            'email'         => ['required', 'string', 'email', 'max:191', 'unique:users'],
            'password'      => ['required', 'string', 'min:6'],
            'phone'         => ['required'],
            'type'          => ['required', Rule::in([User::COMPANY_TYPE, User::CUSTOMER_TYPE])],
        ];

        $profile_social_links = [
            'facebook'      => ['nullable', Rule::requiredIf($isCompanyType), 'url', 'max:191'],
            'twitter'       => ['nullable', Rule::requiredIf($isCompanyType), 'url', 'max:191'],
            'linkedin'      => ['nullable', Rule::requiredIf($isCompanyType), 'url', 'max:191'],
            'instagram'     => ['nullable', Rule::requiredIf($isCompanyType), 'url', 'max:191'],
            'snapchat'      => ['nullable', Rule::requiredIf($isCompanyType), 'url', 'max:191'],
            'youtube'       => ['nullable', Rule::requiredIf($isCompanyType), 'url', 'max:191'],
        ];

        $files_fields = [
            'logo'                  => ['nullable', Rule::requiredIf($isCompanyType), 'image', 'mimes:jpg,jpeg,png'],
            'id_card'               => ['nullable', Rule::requiredIf($isCompanyType), 'file', 'mimes:pdf'],
            'travel_certificate'    => ['nullable', Rule::requiredIf($isCompanyType), 'file', 'mimes:pdf'],
            'tax_card'              => ['nullable', Rule::requiredIf($isCompanyType), 'file', 'mimes:pdf'],
            'business_register'     => ['nullable', Rule::requiredIf($isCompanyType), 'file', 'mimes:pdf'],
        ];

        $fields = array_merge($basic_fields, $profile_social_links, $files_fields);

        return Validator::make($data, $fields);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return \MixCode\User
     */
    protected function create(array $data)
    {
        return (new User())->register($data);
    }
}
