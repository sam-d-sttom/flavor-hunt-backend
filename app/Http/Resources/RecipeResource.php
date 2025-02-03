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
            "message" => $this->message,
            "data" => [
                'id' => $this->recipe->id,
                'title' => $this->recipe->name,
                'description' => $this->recipe->description,
                'ingredients' => $this->recipe->ingredients,
                'instructions' => $this->recipe->instructions,
                'tags' => $this->recipe->tags,
                'prep_time' => $this->recipe->prep_time,
                'cook_time' => $this->recipe->cook_time,
                'total_time' => $this->recipe->total_time,
                'servings' => $this->recipe->servings,
                'calories' => $this->recipe->calories,
                'created_at' => $this->recipe->created_at->format('Y-m-d'),
            ]
        ];
    }
}
