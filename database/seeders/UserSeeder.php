<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Constants\UserRoles;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'id' => 1,
            'name' => 'System user',
            'email' => 'system-user@expertix.ru',
            'password' => 'systemuser',
            'phone' => '',
            'role' => UserRoles::System
        ]);

        User::factory()->create([
            'id' => 2,
            'name' => 'Admin user',
            'email' => 'admin-user@expertix.ru',
            'password' => 'adminuser',
            'phone' => '',
            'role' => UserRoles::Admin
        ]);

        User::factory()->create([
            'id' => 10,
            'name' => 'Test user',
            'email' => 'test1@test.com',
            'password' => '123456',
            'phone' => '',
            'role' => UserRoles::User
        ]);

        User::factory()->create([
            'id' => 11,
            'name' => 'Test student',
            'email' => 'student1@test.com',
            'password' => '123456',
            'phone' => '',
            'role' => UserRoles::Student
        ]);

        User::factory()->create([
            'id' => 12,
            'name' => 'Test teacher',
            'email' => 'teacher1@test.com',
            'password' => '123456',
            'phone' => '',
            'role' => UserRoles::Teacher
        ]);
    }
}
