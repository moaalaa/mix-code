<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MixCode\Rules\Uuid;

class PortfoliosRequest extends FormRequest
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
            'categories_id'     => ['required', 'array', 'min:1'],
            'categories_id.*'   => ['required', new Uuid, Rule::exists('categories', 'id')],
            'images'        => ['required', 'image', 'mimes:jpeg,jpg,png'],
                   
        ];

        if ($this->isMethod('PATCH')) {
            $rules['images']    = ['nullable', 'image', 'mimes:jpeg,jpg,png'];
            
        }

        return $rules;
    }
}
