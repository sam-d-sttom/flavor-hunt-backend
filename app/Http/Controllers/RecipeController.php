<?php

namespace App\Http\Controllers;
use App\Models\Recipe;
use Illuminate\Http\Request;

class RecipeController extends Controller
{
    /**
     * Summary of getAllRecipes
     * returns a json of all recipes
     * @return bool|string
     */
    public function getAllRecipes(){
        $recipes = Recipe::orderBy("id","desc")->get();
        return response()->json([
            'status_code' => '200',
            'message' => 'Successful',
            'data' => $recipes
        ]);
    }


    /**
     * Summary of getAllRecipesByTag
     * Returns a json of recipes based on the tag specified
     * @param \Illuminate\Http\Request $request
     * @return Request
     */
    public function getRecipesByTag(Request $request){
        if(!$request->has('tag')){
            return response()->json([
                    'status_code' => '200',
                    'message' => 'Please specify a tag as a parameter',
                ]);
        }
        $tag = $request['tag'];
        
        $recipes = Recipe::whereRaw("FIND_IN_SET('$tag', tags)")->orderBy("id","desc")
        ->get();

        sleep(5);

        return response()->json([
            'status_code' => '200',
            'data' => $recipes
        ]);
    }

    /**
     * Summary of getLatestRecipes
     * Returns 8 of the most recent recipes
     * @return void
     */
    public function getLatestRecipes(){
        $latest_recipes = Recipe::orderBy('id','desc')->limit(8)->get();
        $latest_nigerian_recipes = $this->getLatestRecipesByCountry('nigerian');
        $latest_italian_recipes = $this->getLatestRecipesByCountry('italian');
        $latest_mexican_recipes = $this->getLatestRecipesByCountry('mexican');
        $latest_french_recipes = $this->getLatestRecipesByCountry('french');
        $latest_indian_recipes = $this->getLatestRecipesByCountry('indian');
        $latest_chinese_recipes = $this->getLatestRecipesByCountry('chinese');

        $array_of_latest_recipes = [
            'latest_recipes' => $latest_recipes, 
            'latest_nigerian_recipes' => $latest_nigerian_recipes, 
            'latest_mexican_recipes' => $latest_mexican_recipes, 
            'latest_italian_recipes' => $latest_italian_recipes, 
            'latest_indian_recipes' => $latest_indian_recipes, 
            'latest_french_recipes' => $latest_french_recipes, 
            'latest_chinese_recipes' => $latest_chinese_recipes
        ];

        return response()->json([
            'status_code' => '200',
            'message' => 'Successful',
            'data' => $array_of_latest_recipes
        ]);
    }

    /**
     * Summary of getLatestRecipesByCountry
     * returns latest recipes based on country
     * @param \Illuminate\Http\Request $request
     */
    public function getLatestRecipesByCountry(string $country)
    {

        $recipes = Recipe::whereRaw("FIND_IN_SET('$country', country)")->orderBy("id","desc")->limit(3)->get();

        return $recipes;
    }
}
