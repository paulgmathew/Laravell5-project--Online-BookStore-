<?php

use Illuminate\Database\Seeder;
use App\User;

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
        $user->username = "paul";
        $user->password = bcrypt("paul_test");
        $user->fullName = "Paul G Mathew";
        $user->address ="7650 McCallum Blvd,Dallas ,TX";
        $user->phone = "123456789";
        $user->email = "abc@gmail.com";
        $user->type = 1;
        $user->save();
        
        $user = new User();
        $user->username = "admin";
        $user->password = bcrypt("admin");
        $user->fullName = "";
        $user->address ="";
        $user->phone = "";
        $user->email = "";
        $user->type = 0;
        $user->save();
        
    }
}
