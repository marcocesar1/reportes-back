<?php

namespace Database\Seeders;

use App\Models\Address;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::factory()
                ->count(50)
                ->create();

        $users->each(function ($user) {
            $user->address()->save(Address::factory()->make());
        });
    }
}
