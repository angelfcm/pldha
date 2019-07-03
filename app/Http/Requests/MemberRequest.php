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
            'id_number' => 'required|integer',
            'fullname' => 'required|string',
            'phone_number' => 'required',
            'email' => 'required|email',
            'country_abbr' => 'required|string',
            'state_code' => 'required',
            'town_code' => 'required',
            'credential_photo' => 'required|url',
            'official_id_photo_back' => 'required|url',
            'official_id_photo_front' => 'required|url',
            'other_official_id_photo' => 'nullable|url',
            'occupation_code' => 'required',
            'occupation' => 'required|string',
            'member_comment' => 'nullable|string|max:120',
            'verified' => 'required|boolean',
        ];
    }

    protected function prepareForValidation()
    {
        $this->merge([
            'country_abbr' => $this->input('country_abbr') ? substr($this->input('country_abbr'), 0, 3) : null,
            'verified' => $this->has('verified') && $this->input('verified') == true ? true : false,
        ]);
    }

    public function messages()
    {
        return [
            'fullname.required' => 'El nombre es requerido.',
            'occupation_code.required' => 'El código de cargo es requerido.',
            'occupation.required' => 'La ocupación es requerida.',
            'country_abbr.required' => 'El país es requerido.',
            'state_code.required' => 'El código de estado es requerido.',
            'town_code.required' => 'El código de ciudad es requerido.',
            'credential_photo.required' => 'La fotografía de la credencial es requerida.',
            'credential_photo.url' => 'La fotografía de la credencial debe ser una url.',
            'official_id_photo_back.required' => 'La fotografía del reverso de la identificación es requerida.',
            'official_id_photo_back.url' => 'La fotografía del reverso de la identificación debe ser una url.',
            'official_id_photo_front.required' => 'La fotografía frontal de la identificación es requerida.',
            'official_id_photo_front,url' => 'La fotografía frontal de la identificación debe ser una url.',
            'other_official_id_photo.url' => 'La fotografía opcional (PASAPORTE) debe ser una url.',
            'member_comment.max' => 'El comentario solo puede tener :value carácteres como máximo.',
            'id_number.required' => 'El número de identificación es requerido.',
            'id_number.integer' => 'El número de identificación debe ser numérico.',
            'phone_number.required' => 'El el número telefónico es requerido.',
            'email.required' => 'El correo electrónico es requerido.',
            'verified.required' => 'El estado de verificación es requerido.',
            'verified.boolean' => 'El estado de verificación solo puede ser verdadero o falso.',
        ];
    }
}
