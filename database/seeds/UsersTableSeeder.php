<?php

use Illuminate\Database\Seeder;
use App\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Admin
        User::create([
            'name' => 'David',
            'email' => 'davidhalberstad@gmail.com',
            'password' => bcrypt('david9784'),
            'role' => 0
        ]);

         // Support
         User::create([
         'name' => 'Suport',
         'email' => 'support@gmail.com',
         'password' => bcrypt('david9784'),
         'role' => 1
        ]);

        // Client
        User::create([
        'name' => 'Client',
        'email' => 'client@gmail.com',
        'password' => bcrypt('david9784'),
        'role' => 2
        ]);


    }
}
