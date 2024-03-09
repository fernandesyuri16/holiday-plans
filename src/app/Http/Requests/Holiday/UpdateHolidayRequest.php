<?php

namespace App\Http\Requests\User;

use Illuminate\Foundation\Http\FormRequest;

class UpdateHolidayRequest extends FormRequest
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
            'title' => 'nullable|max:50',
            'description' => 'nullable|max:150',
            'date' => 'nullable|max:50',
            'location' => 'nullable|unique:users|max:20',
            'participants' => 'nullable|max:50',
            'password' => 'nullable|max:50'
        ];
    }
}
