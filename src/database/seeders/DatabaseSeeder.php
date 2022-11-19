<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory([
            'email' => 'test@mail.com',
            'password' => Hash::make('test'),
            'api_token' => 'pptZ8CrKojX1eGJ5uReqhZnnEC1op8KzsVWoYIMo'
        ])
        ->has(Company::factory()->count(5), 'companies')
        ->create();

        User::factory()
            ->has(Company::factory()->count(5), 'companies')
            ->count(10)
            ->create();
    }
}
