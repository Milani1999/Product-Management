<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class IssuerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name' => 'Issuer User',
            'email' => 'issuer@example.com',
            'role_id' => 3,
            'password' => Hash::make('password')
        ]);
    }
}