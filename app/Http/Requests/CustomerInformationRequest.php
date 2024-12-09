<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CustomerInformationRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return session()->has('cart') && count(session()->get('cart'))>0;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'salutation' => ['required', 'string', 'max:64'],
            'prename' => ['required', 'string', 'max:255'],
            'lastname' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255'],
            'phone' => ['nullable', 'string', 'max:64'],
            'zip' => ['required', 'string', 'regex:/^\d+$/', 'max:6'],
            'place' => ['required', 'string', 'max:255'],
            'street' => ['required', 'string', 'max:128'],
            'house_number' => ['required', 'string', 'max:4'],
        ];
    }
}
