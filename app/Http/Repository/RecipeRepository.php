<?php

namespace App\Http\Repository;

use App\Models\Recipe;
use Illuminate\Support\Facades\Auth;

class RecipeRepository
{
    /**
     * Summary of createRecipe
     * create a recipe.
     * @param array $validatedRequest
     * @return recipe
     */
    public function createRecipe(Array $validatedRequest) {

        $user_id = Auth::id();

        $validatedRequest['user_id'] = $user_id;

        $recipe = Recipe::create($validatedRequest);

        return $recipe;
    }
}
