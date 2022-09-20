<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class QuestionUpdateRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'question'=>'required|min:3',
            'image'=>'image|nullable|max:1024|mimes:jpeg,jpg,png',
            'answer1'=>'required|min:1',
            'answer2'=>'required|min:1',
            'answer3'=>'required|min:1',
            'answer4'=>'required|min:1',
            'correct_answer'=>'required',

        ];
    }
    public function attributes()
    {
        return [
            'question'=>'Soru',
            'image'=>'Görsel',
            'answer1'=>'1. Cevap',
            'answer2'=>'2. Cevap',
            'answer3'=>'3. Cevap',
            'answer4'=>'4. Cevap',
            'correct_answer'=>'Doğru Cevap',

        ];
    }
}