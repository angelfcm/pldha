<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MemberRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return \Auth::check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //''
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'country_abbr' => $this->input('country_abbr') ? substr($this->input('country_abbr'), 0, 3) : null,
        ]);
    }
}
