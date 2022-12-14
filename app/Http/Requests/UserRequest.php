<?php

namespace App\Http\Requests;

use Illuminate\Validation\Rules;
use Illuminate\Support\Facades\Http;
use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        $response = Http::get("https://api.leader.sale/user/".$this->code."/by-code-saler");

        if((int) $response->status() === 200)
        {
            $cIn = $this->code;
            $this->leader_user_id = $response['body'][0]['UserId'];
        }

        return [
            'name' => ['required', 'string', 'max:255'],
            'place' => ['required', 'string', 'max:100'],
            'manager' => ['required', 'string', 'max:100'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            'code' => ['required', 'string', 'max:100', 'unique:users,code', "in:$cIn"],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,'.$this->hidUser.',id,deleted_at,NULL'],
        ];
    }
}
