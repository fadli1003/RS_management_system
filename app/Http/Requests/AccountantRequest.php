<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password;

class AccountantRequest extends FormRequest
{
  public function authorize(): bool
  {
    return true;
  }

  public function rules(): array
  {
    return [
      'full_name' => 'required|string|max:100',
      'address' => 'required|string|max:255',
      'email' => 'required|email|string|max:100',
      'password' => 'required|confirmed|' . Password::min(6)->max(50)->letters()->mixedCase()->symbols(),
      'birth_date' => 'nullable|date',
      'gender' => 'required|string|in:male,female',
      'phone' => 'nullable|string|max:25',
      'mobile' => 'nullable|string|max:500',
      'emergency' => 'required|string|max:50',
      'picture' => 'nullable|mimes:png,jpg,jpeg,webp|max:2048',
      'departements' => 'nullable|string|max:30'
    ];
  }
}
