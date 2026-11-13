<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class ChirpSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::count() < 3
            ? collect([
                User::firstOrCreate(['email' => 'alice@example.com'], [
                    'name' => 'Alice Developer',
                    'password' => bcrypt('password'),
                ]),
                User::firstOrCreate(['email' => 'bob@example.com'], [
                    'name' => 'Bob Builder',
                    'password' => bcrypt('password'),
                ]),
                User::firstOrCreate(['email' => 'carol@example.com'], [
                    'name' => 'Carol Coder',
                    'password' => bcrypt('password'),
                ]),
            ])
            : User::take(3)->get();

        $chirps = [
            'Acabei de descobrir as Collections do Laravel. Que coisa linda!',
            'Migrations, seeders e factories: o trio que salva o meu dia.',
            'Hoje o deploy foi de primeira. Milagre ou boa prática?',
        ];

        foreach ($chirps as $message) {
            $users->random()->chirps()->create([
                'message' => $message,
                'created_at' => now()->subMinutes(rand(5, 1440)),
            ]);
        }
    }
}
