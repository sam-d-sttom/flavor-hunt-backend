<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RecipeResource;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{


    /**
     * Summary of index
     * Get a list of all recipes
     * @return void
     */
    public function index()
    {
        $recipes = RecipeResource::collection(Recipe::all());
        return response()->json($recipes);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }


    /**
     * Summary of store
     * Store a new recipe
     * @param \Illuminate\Http\Request $request
     * @return void
     */
    public function store(RecipeRequest $request)
    {

        $validatedRequest = $request->validated();

        $validatedRequest['instructions'] = json_encode($validatedRequest['instructions']);
        $validatedRequest['ingredients'] = json_encode($validatedRequest['ingredients']);

        $user_id = Auth::id();

        $validatedRequest['user_id'] = $user_id;

        $recipe = Recipe::create($validatedRequest);

        return response()->json([
            "message" => "Recipe created successfully",
            "recipe" => $recipe
        ]);
    }


    /**
     * Summary of show
     * get a recipe by id
     * @param string $id
     * @return void
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Summary of update
     * modify a recipe.
     * @param \Illuminate\Http\Request $request
     * @param string $id
     * @return void
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Summary of destroy
     * delete a recipe.
     * @param string $id
     * @return void
     */
    public function destroy(string $id)
    {
        //
    }
}
