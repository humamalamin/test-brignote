<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

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
        $user->name = "admin";
        $user->email = "admin@example.com";
        $user->password = bcrypt("qwert12345");
        $user->email_verified_at = now();
        $user->save();
    }
}
