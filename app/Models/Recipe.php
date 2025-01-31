<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    //

    /**
     * Summary of user
     * relationship with the user model.
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Recipe>
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
