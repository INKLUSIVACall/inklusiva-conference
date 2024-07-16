<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class MeetingRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $validations = [
            'name' => 'required|string',
            'should_record' => 'boolean',
            'sign_language_interpreter' => 'boolean',
            'text_interpreter' => 'boolean',
        ];

        if ($this->get('meetingtype') === 'planned') {
            $validations['start_date'] = 'required|date';
            $validations['start_time'] = 'required|date_format:H:i';
        }
        return $validations;
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Bitte geben Sie einen Namen für das Meeting an.',
            'start_date.required' => 'Bitte geben Sie ein Startdatum für das Meeting an.',
            'start_time.required' => 'Bitte geben Sie eine Startuhrzeit für das Meeting an.',
            'start_date.date' => 'Bitte geben Sie ein gültiges Startdatum für das Meeting an.',
            'start_time.date_format' => 'Bitte geben Sie eine gültige Startuhrzeit für das Meeting an.',
        ];
    }
}
