<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;


class UserTableSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "esteban lizarraga";
        $user->email = "esteban.daniel99@hotmail.com";
        $user->password = bcrypt("secret");
         $user->save(); 


    }
}
