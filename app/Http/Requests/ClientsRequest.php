<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MixCode\Rules\Uuid;

class ClientsRequest extends FormRequest
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
            // Basic Info
            'en_name'       => ['required', 'string', 'max:191'],
            'ar_name'       => ['required', 'string', 'max:191'],
            'en_type'       => ['required', 'string', 'max:191'],
            'ar_type'       => ['required', 'string', 'max:191'],
            'image'         => ['required', 'image', 'mimes:jpeg,jpg,png'],
                   
        ];

        if ($this->isMethod('PATCH')) {
            $rules['images']    = ['nullable', 'image', 'mimes:jpeg,jpg,png'];
            
        }

        return $rules;
    }
}
