<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LeadRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        $aValidaciones = [
                            'name' => ['required', 'string', 'max:50'],
                            'phone' => ['required', 'min:10', 'max:10'],
                            'email' => ['required', 'string', 'email', 'max:30'],
                        ];

        if(request()->has('cmbPlace'))
            $aValidaciones['cmbPlace'] = ['required'];

        if(request()->has('cmbBusiness'))
            $aValidaciones['cmbBusiness'] = ['required'];

        return $aValidaciones;
    }
}
