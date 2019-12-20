<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = array([
            [
                "name" => "Admin",
                "email" => "admin@softpyramid.com",
                "password" => bcrypt('qwerty123'),
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
            ],[
                "name" => "User",
                "email" => "user@softpyramid.com",
                "password" => bcrypt('qwerty123'),
                "created_at" => date('Y-m-d'),
                "updated_at" => date('Y-m-d'),
            ],
        ]);

        foreach ($users as $user)
            DB::table('users')->insert($user);


        // assigning roles to respective users
        for ($i=1; $i <= 2; $i++) {
            DB::table('model_has_roles')->insert([
                'role_id' => $i,
                'model_type' => 'App\User',
                'model_id' => $i
            ]);
        }
    }
}
