<?php

namespace Database\Seeders;

use App\Enums\UserType;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
/**
 * Class UserSeeder
 * @package Database\Seeders
 */
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array(
            'first_name' => "Admin",
            'last_name' => "User",
            'email' => "admin@gmail.com",
            'password' => Hash::make("123456"),
            'type' => UserType::ADMIN,
        ));
    }
}
