<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    public function run()
    {
        $users = [
            [
                'id'             => 1,
                'name'           => 'Admin',
                'email'          => 'admin@admin.com',
                'password'       => '$2y$10$aYlBw6eS478c.P5vHvPnduUvqs7YeeoAEetnuhog1NJyzABhhzf3K',
                'remember_token' => null,
            ],
        ];

        User::insert($users);
    }
}
