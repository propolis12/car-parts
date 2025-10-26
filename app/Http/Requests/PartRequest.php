<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class PartRequest extends FormRequest
{

    public function authorize(): bool { return true; }


    public function rules(): array
    {
        $part = $this->route('part');

        return [
            'name' => ['required', 'string', 'max:255'],
            'serialnumber' => ['required', 'string', 'max:255', Rule::unique('parts', 'serialnumber')
                ->ignore($part?->id)
            ],
            'car_id' => ['required', 'exists:cars,id'],
        ];
    }

    public function messages(): array
    {
        return [
            'serialnumber.unique' => 'Tento sériový kód už existuje.',
        ];
    }

    protected function prepareForValidation(): void
    {
        $this->merge([
            'serialnumber' => $this->input('serialnumber') !== null
                ? trim((string)$this->input('serialnumber'))
                : null,
            'car_id' => $this->input('car_id') ? (int)$this->input('car_id') : null,
        ]);
    }
}
