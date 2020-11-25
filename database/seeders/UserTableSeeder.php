<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = new User();
        $user->name = "Manoban";
        $user->email = "manoban@correo.com";
        $user->password = bcrypt("Choi.210700");
        $user->save();
    }
}
