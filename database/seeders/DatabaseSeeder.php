<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     *
     * Creates one default Pengurus RT (Admin) account so the app is usable
     * immediately after `php artisan migrate --seed`. Warga accounts are
     * created via the public registration form.
     */
    public function run(): void
    {
        User::firstOrCreate(
            ['email' => 'admin@wargakita.test'],
            [
                'name' => 'Ketua RT 09',
                'password' => Hash::make('password'),
                'level' => 'Admin',
            ]
        );
    }
}
