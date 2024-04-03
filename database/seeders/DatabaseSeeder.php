<?php

namespace Database\Seeders;

use App\Models\Company;
use App\Models\CompanyType;
use App\Models\User;
use App\Models\UserInformation;
use App\Models\UserStatus;
use App\Models\UserType;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        UserType::factory(3)->create();
        UserStatus::factory(3)->create();
        User::factory(500)->create();
        UserInformation::factory(500)->create();
        CompanyType::factory(10)->create();
        Company::factory(200)->create();

        User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}