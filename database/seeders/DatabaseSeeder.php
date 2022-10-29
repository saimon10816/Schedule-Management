<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\User;
use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $user= User::create([
            'name' => 'Company B',
            'email' => 'companyb@gmail.com',
            'password' => Hash::make('12345678'),
        ]);
        $role = Role::create([
            'slug' => 'userb',
            'name' => 'UserB',
        ]);

        $user->roles()->sync($role->id);
    }
}
