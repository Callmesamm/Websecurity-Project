<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        $roles = [
            ['name' => 'admin'],
            ['name' => 'user'],
        ];

        foreach ($roles as $role) {
            Role::firstOrCreate($role);
        }
    }
} 