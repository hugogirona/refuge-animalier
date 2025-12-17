<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreAdoptionRequest extends FormRequest
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
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'pet_id' => 'required|exists:pets,id',

            'first_name' => 'required|string|max:255',
            'last_name' => 'required|string|max:255',
            'email' => [
                'required',
                'email',
                'max:255',
                Rule::unique('adoption_requests')->where(function ($query) {
                    return $query->where('pet_id', $this->input('pet_id'));
                }),
            ],
            'phone' => 'required|string|max:20',

            'address' => 'required|string|max:255',
            'zip_code' => 'required|numeric|digits_between:4,5',
            'city' => 'required|string|max:255',

            'accommodation_type' => 'required|in:house,appartement',
            'garden' => 'required|in:yes,no',

            'has_other_pets' => 'nullable|string',
            'had_same' => 'nullable|string',

            'available_days' => 'required|array|min:1',
            'available_hours' => 'required|array|min:1',
            'preferred_contact_method' => 'required|in:phone,email',

            'message' => 'nullable|string|max:2000',

            'rgpd' => 'accepted',
            'newsletter_consent' => 'nullable',
        ];
    }

    public function messages(): array
    {
        return [
            'email.unique' => 'Vous avez déjà envoyé une demande pour cet animal avec cette adresse email.',
        ];
    }

}
