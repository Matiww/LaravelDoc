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
        /**
         * Input #date not working properly with date mask, sending 'dd/mm/yyyy' even when empty
         * This makes sure to store the note if actually no value is passed
         * FIXME
         */
        $requestData = $this->request->all();
        if($requestData['date'] == 'dd/mm/yyyy') {
            $requestData['date'] = null;
        }
        $this->request->replace($requestData);

        return [
            'title'   => 'required|max:90',
            'content' => 'nullable',
            'date'    => 'nullable'
        ];
    }
}
