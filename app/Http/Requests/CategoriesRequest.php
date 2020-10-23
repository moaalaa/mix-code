<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use MixCode\Category;

class CategoriesRequest extends FormRequest
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
        return [
            'en_name'       => ['required', 'string', 'max:191'],
            'ar_name'       => ['required', 'string', 'max:191'],
            'status'        => ['required', Rule::in([Category::ACTIVE_STATUS, Category::INACTIVE_STATUS])],
            'icon'          => ['nullable', 'image', 'mimes:jpg,jpeg,png'],
        ];
    }
}
