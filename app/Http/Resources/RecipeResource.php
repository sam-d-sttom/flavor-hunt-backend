<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class RecipeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'title' => $this->name,
            'description' => $this->description,
            'ingredients' => $this->ingredients,
            'instructions' => $this->instructions,
            'tags' => $this->tags,
            'prep_time' => $this->prep_time,
            'cook_time' => $this->cook_time,
            'total_time' => $this->total_time,
            'servings' => $this->servings,
            'calories' => $this->calories,
            'created_at' => $this->created_at->format('Y-m-d'),
        ];
    }
}
