<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class EditProductRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric',
            'stock' => 'required|numeric',
            'images' => 'nullable|array|max:10',
            'images.*' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048'
        ];
    }

    public function messages()
    {
        return  [
            'name.required' => 'Bitte geben Sie einen Namen für das Produkt ein.',
            'description.required' => 'Bitte geben Sie eine Beschreibung für das Produkt ein.',
            'price.required' => 'Bitte geben Sie einen Preis für das Produkt ein.',
            'stock.required' => 'Bitte geben Sie den Lagerbestand für das Produkt ein.',
            'images.*.mimes' => 'Das Bild muss ein Bildformat wie jpeg, png, jpg, gif oder svg haben.',
        ];
    }
}
