<?php

namespace MixCode\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ReviewsRequest extends FormRequest
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
            'name'      => 'required|string|max:191',
            'email'     => 'required|string|email',
            'review'    => 'required|string|max:500',
            'rate'      => 'required|integer|min:1|max:5',
        ];
    }
}
