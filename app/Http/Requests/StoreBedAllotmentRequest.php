<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreBedAllotmentRequest extends FormRequest
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
          'bed_id' => 'required|exists:beds,id',
          'patient_id' => 'required|exists:users,id',
          'start_date' => 'required|date',
          'start_time' => 'required|date_format:H:i',
          'end_date' => 'required|date|after:start_date',
          'end_time' => 'required|date_format:H:i|after:start_time'
        ];
    }
}
