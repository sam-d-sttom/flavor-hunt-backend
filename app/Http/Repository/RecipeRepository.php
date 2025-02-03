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
        $validatedRequest['instructions'] = json_encode($validatedRequest['instructions']);
        $validatedRequest['ingredients'] = json_encode($validatedRequest['ingredients']);

        //Tags is not normally required, so should be encoded conditionally.
        if(isset($validatedRequest['tags'])) {
            $validatedRequest['tags'] = json_encode($validatedRequest['tags']);
        }

        $user_id = Auth::id();

        $validatedRequest['user_id'] = $user_id;

        $recipe = Recipe::create($validatedRequest);

        return $recipe;
    }
}
