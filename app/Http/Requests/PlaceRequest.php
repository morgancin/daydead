<?php

namespace App\Http\Requests;

use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Http\FormRequest;

class PlaceRequest extends FormRequest
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
        $cIn = null;
        $response = Http::get("https://api.leader.sale/catalog/".$this->code."/place-valid");

        if((int) $response->status() === 200)
            $cIn = $this->code;

        return [
            'name' => ['required', 'string', 'max:100'],
            'code' => ['required', 'string', 'max:100', "in:$cIn"],
        ];
    }
}
