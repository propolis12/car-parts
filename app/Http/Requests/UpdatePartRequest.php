<?php


namespace App\Http\Requests;


use Illuminate\Foundation\Http\FormRequest;


class UpdatePartRequest extends FormRequest
{
    public function authorize(): bool { return true; }


    public function rules(): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'serialnumber' => ['required', 'string', 'max:255'],
            'car_id' => ['required', 'exists:cars,id'],
        ];
    }
}
