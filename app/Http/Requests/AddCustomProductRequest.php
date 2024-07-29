<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AddCustomProductRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $commonRules = [
            'cashback' => 'required',
            'owner' => 'required',
            'owner_email' => 'required|email',
        ];

        if (request()->type == 'add-from-suppot') {
            $specificRules = [
                'link' => 'required',
            ];
        } else {
            $specificRules = [
                'title' => 'required',
                'price_in_store' => 'required',
                'category_id' => 'required',
                'photos' => 'required',
                'photos.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            ];
        }
    
        return array_merge($commonRules, $specificRules);
    }
    

    public function messages(): array
    {
        return [
            'cashback' =>"Поле Кешбек обязательно для заполнения",
            'owner' => 'Поле Владелец обязательно для заполнения',
            'owner_email'=> 'Поле Электронная почта обязательно для заполнения',
            'link' => 'Поле Ссылка обязательно для заполнения',
            'title' => 'Поле Название обязательно для заполнения',
            'price_in_store' => 'Поле Цена обязательно для заполнения',
            'category_id'=> 'Поле Категория обязательно для заполнения',
            'photos.*' => 'Поле Фотографии обязательно для заполнения и должно быть тип: изображения',
        ];
    }
}
