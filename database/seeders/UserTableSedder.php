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
          $user->role_id = 1; 
         $user->save(); 

          $user = new User();
        $user->name = "daniel cota";
        $user->email = "danielcota99@hotmail.com";
        $user->password = bcrypt("darkside99");
          $user->role_id = 2; 
         $user->save(); 



    }
}
