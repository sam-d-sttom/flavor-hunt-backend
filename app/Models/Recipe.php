<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $fillable = [
        "name",
        "description",
        "truncated_description",
        "country",
        "ingredients",
        "procedure",
        "img_src",
        "img_alt",
        "tags",
    ] ;
}
