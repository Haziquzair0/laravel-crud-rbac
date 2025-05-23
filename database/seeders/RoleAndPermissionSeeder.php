<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\RolePermission;
use App\Models\UserRole;

class RoleAndPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Assign "User" role to user with ID 2
        $userRole = UserRole::create([
            'user_id' => 2, // Regular User's actual ID
            'role_name' => 'User',
            'description' => 'Regular user'
        ]);

        // Give "User" role the "Create" and "Retrieve" permissions
        RolePermission::create([
            'role_id' => $userRole->role_id,
            'description' => 'Create'
        ]);
        RolePermission::create([
            'role_id' => $userRole->role_id,
            'description' => 'Retrieve'
        ]);

        // Assign "Admin" role to user with ID 1
        $adminRole = UserRole::create([
            'user_id' => 1, // Admin User's actual ID
            'role_name' => 'Admin',
            'description' => 'Administrator'
        ]);

        // Give "Admin" role all permissions
        foreach (['Create', 'Retrieve', 'Update', 'Delete'] as $perm) {
            RolePermission::create([
                'role_id' => $adminRole->role_id,
                'description' => $perm
            ]);
        }
    }
}