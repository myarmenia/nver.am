<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            "email" => [ "required","email"],
            "password" => ["required","min:6"]
        ];
    }
    public function messages(): array
    {
        return [
            "email.required" => "Սխալ մուտքանուն",
            "email.email" => "Սխալ մաիլ",
            "password.required" => "Սխալ գաղտնաբառ",
            "password.min" => "Գաղտնաբառը պետք է լինի ամենաքիչը 6 նիշ",

        ];
    }
}
