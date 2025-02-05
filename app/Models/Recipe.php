<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //
    protected $fillable = [
        'name',
        'description',
        'ingredients',
        'instructions',
        'tags',
        'prep_time',
        'cook_time',
        'total_time',
        'servings',
        'calories',
    ];

    protected $casts = [
        'ingredients'=> 'array',
        'instructions'=> 'array',
        'tags'=> 'array',
    ];

    /**
     * Summary of user
     * relationship with the user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Recipe>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function tag()
    {
        return $this->belongsTo(Tag::class);
    }
}
