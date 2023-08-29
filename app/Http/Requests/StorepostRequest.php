<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StorepostRequest extends FormRequest
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
        return [
            'title' => 'required|max:50',
            'cover_image' => 'image|max:550',
            'category_id' => 'required|exists:categories,id' // Corretto il nome del campo "category_id"
        ];
    }

    public function messages()
    {
        return [
            'title.required' => 'Il titolo è obbligatorio',
            'title.max' => 'Il titolo deve essere lungo al massimo :max caratteri',
            'cover_image.image' => 'Il file contiene un formato non supportato',
            'cover_image.max' => 'Il nome del file deve contenere meno di :max caratteri', // Corretto il messaggio
            'category_id.required' => 'Devi selezionare una categoria',
            'category_id.exists' => 'Categoria selezionata non valida'
        ];
    }
}