<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CarRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'is_registered' => ['nullable', 'boolean'],

            'registration_number' => [
                'nullable',
                'required_if:is_registered,1',
                'string',
                'max:30',
                'regex:/^[A-Z]{2}[-\s]?\d{3}[-\s]?[A-Z]{2}$/i',
                 Rule::unique('cars', 'registration_number')
                    ->where(fn ($q) => $q->whereNotNull('registration_number')),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'registration_number.required_if' => 'EČV je povinné, ak je auto registrované.',
            'registration_number.regex' => 'Zadaj EČV v tvare napr. BA-123AB alebo AA 123 AA.',
            'registration_number.unique' => 'Toto EČV už existuje.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $isReg = filter_var($this->input('is_registered'), FILTER_VALIDATE_BOOL);
        $regNo = $this->input('registration_number');

        if ($regNo !== null && $regNo !== '') {
            $regNo = strtoupper(preg_replace('/[\s\-]+/', '', $regNo));
        }

        $this->merge([
            'is_registered' => $isReg ? 1 : 0,
            'registration_number' => $regNo,
        ]);
    }
}
