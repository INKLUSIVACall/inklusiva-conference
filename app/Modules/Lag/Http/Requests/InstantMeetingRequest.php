<?php

namespace App\Modules\Lag\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class InstantMeetingRequest extends FormRequest
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
            'firstname' => 'required|string',
            'lastname' => 'required|string',
            'email' => 'required|email',
            'meetingTitle' => 'required|string',
            'privacy' => 'accepted',
        ];

        return $validations;
    }

    public function messages(): array
    {
        return [
            'firstname.required' => 'Bitte geben Sie einen Vornamen ein.',
            'lastname.required' => 'Bitte geben Sie einen Nachnamen ein.',
            'email.required' => 'Bitte geben Sie eine Email-Adresse ein.',
            'email.email' => 'Bitte geben Sie eine gültige Email-Adresse ein.',
            'meetingTitle.required' => 'Bitte geben Sie den Titel des Meetings ein.',
            'privacy.accepted' => 'Die Datenschutzerklärung muss akzeptiert werden.',
        ];
    }
}
