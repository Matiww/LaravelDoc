<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNote extends FormRequest {
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize() {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules() {
        return [
            'title'   => 'required|max:90',
            'content' => 'nullable',
            'date'    => 'nullable|date',
            'important_level' => 'nullable|integer|between:1,3'
        ];
    }

    /**
     * Override default error messages
     *
     * @return array
     */
    public function messages()
    {
//        TODO add languages
        return [
            'title.required' => 'Tytuł jest wymagany.',
            'title.max' => 'Tytuł nie może być dłuższy niż 90 znaków.',
            'date.date' => 'Termin nie jest prawidłową datą.',
            'important_level.integer' => 'Wartość poziomu musi być liczbą całkowitą.',
            'important_level.between' => 'Wartość poziomu musi zawierać się w granicach :min - :max.'
        ];
    }
}
