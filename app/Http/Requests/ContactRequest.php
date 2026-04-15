<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name'           => ['required', 'string', 'min:2', 'max:120'],
            'email'          => ['required', 'email', 'max:255'],
            'phone'          => ['nullable', 'string', 'max:30'],
            'property_id'    => ['nullable', 'exists:properties,id'],
            'arrival_date'   => ['nullable', 'date', 'after_or_equal:today'],
            'departure_date' => ['nullable', 'date', 'after:arrival_date'],
            'guests'         => ['nullable', 'integer', 'min:1', 'max:30'],
            'message'        => ['required', 'string', 'min:10', 'max:2000'],
            'inquiry_type'   => ['nullable', 'in:rental,wedding,dossier,other'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'           => 'Por favor, introduzca su nombre.',
            'email.required'          => 'Por favor, introduzca su email.',
            'email.email'             => 'El email no tiene un formato válido.',
            'message.required'        => 'Por favor, escriba su mensaje.',
            'message.min'             => 'El mensaje debe tener al menos 10 caracteres.',
            'arrival_date.after_or_equal' => 'La fecha de llegada no puede ser en el pasado.',
            'departure_date.after'    => 'La fecha de salida debe ser posterior a la llegada.',
        ];
    }
}
