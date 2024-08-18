<?php

namespace Database\Seeders;

use App\Models\Recipe;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        User::factory()->create();
        Recipe::factory(10)->create([
            "country"=> "Nigerian",
            "ingredients"=> "vjdsvsvs, dsvsvsvs, dvsdvsdvsdv, nwidnwncn, vsvnsjvninveve, vivsvinvevnve,vivnveivneiwe",
            "procedure"=> "nksdlvkdsvlkndlksnvsdkddnkkkkkkkdsvnvsdvvvvvvvvvvvvee, osidiieifejfvnvuhhjjjjjjjejmmnjkkkkjuu8877uuuu, vivnivnsidnvivviidnsiwe, nvjsnvduvhieiesvnvisnvnisvs, inewiiiieaiunnnefehihfew, hfehihwfwfwifhf",
            "img_src"=> "http://localhost:3000/static/media/fun-logo.c757787c6032a35839c3.jpg",
            "img_alt"=> "Food",
            "tags"=> "Appertizers,30 minutes,crunchy",
        ]);   
    }
}
