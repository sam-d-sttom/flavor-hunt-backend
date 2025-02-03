<?php

namespace App\Http\Requests;
use Illuminate\Foundation\Http\FormRequest;

class RecipeRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'sometimes|string',
            'ingredients' => 'required|array',
            'ingredients.*.name' => 'required|string',
            'ingredients.*.quantity' => 'required|numeric',
            'ingredients.*.unit' => 'required|string',
            'instructions' => 'required|array',
            'tags' => 'sometimes|array',
            'prep_time' => 'sometimes|integer',
            'cook_time' => 'sometime|integer',
            'total_time'=> 'sometimes|integer',
            'servings'=> 'sometimes|integer',
            'calories'=> 'sometimes|integer',
        ];
    }

    /**
     * Get custom error messages for the defined validation rules.
     *
     * @return array<string, string>
     */
    public function messages(): array
    {
        return [
            'name.required' => 'The recipe name is required.',
            'name.string' => 'The recipe name must be a string.',
            'name.max' => 'The recipe name may not be greater than 255 characters.',
            'ingredients.required' => 'The ingredients are required.',
            'ingredients.array' => 'The ingredients must be an array.',
            'ingredients.*.name.required' => 'Each ingredient must have a name.',
            'ingredients.*.name.string' => 'Each ingredient name must be a string.',
            'ingredients.*.quantity.required' => 'Each ingredient must have a quantity.',
            'ingredients.*.quantity.numeric' => 'Each ingredient quantity must be a number.',
            'ingredients.*.unit.required' => 'Each ingredient must have a unit.',
            'ingredients.*.unit.string' => 'Each ingredient unit must be a string.',
            'instructions.required' => 'The instructions are required.',
            'instructions.array' => 'The instructions must be an array.',
        ];
    }
}
