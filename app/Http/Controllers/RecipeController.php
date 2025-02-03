<?php

namespace App\Http\Controllers;

use App\Http\Repository\RecipeRepository;
use App\Models\User;
use App\Models\Recipe;
use Illuminate\Http\Request;
use App\Http\Requests\RecipeRequest;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\RecipeResource;
use Illuminate\Support\Facades\Validator;

class RecipeController extends Controller
{

    private $recipeRepository;

    public function __construct(RecipeRepository $recipeRepository)
    {
        $this->recipeRepository = $recipeRepository;
    }

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
     * @param \App\Http\Requests\RecipeRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(RecipeRequest $request)
    {

        $validatedRequest = $request->validated();

        $recipe = $this->recipeRepository->createRecipe($validatedRequest);

        $recipe["instructions"] = json_decode($recipe["instructions"]);
        $recipe["ingredients"] = json_decode($recipe["ingredients"]);

        if($recipe['tags'] !== null) {
            $recipe['tags'] = json_decode($recipe['tags']);
        }

        return (new RecipeResource((object) ["message" => "Recipe created successfully", "recipe" => $recipe]))->response()->setStatusCode(201);
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
