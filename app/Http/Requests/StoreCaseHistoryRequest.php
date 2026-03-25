<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCaseHistoryRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'patient_id' => 'required|exists:users,id',
            'date' => 'required|date',
            'title' => 'required|string|max:50',
            'food_allergies' => 'required|string',
            'bleed_tendency' => 'required',
            'heart_disease' => 'required',
            'blood_pressure' => 'required',
            'diabetic' => 'required',
            'surgery' => 'required',
            'accident' => 'required|string',
            'family_medical_history' => 'required',
            'current_medication' => 'required',
            'female_pregnancy' => 'required',
            'breast_feeding' => 'required',
            'health_insurance' => 'required',
            'low_income' => 'required',
            'reference' => 'required',
            'others' => 'required',
            'status' => 'required',
        ];
    }
}
