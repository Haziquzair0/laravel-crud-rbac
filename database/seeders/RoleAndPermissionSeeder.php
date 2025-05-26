<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\UserRole;
use App\Models\RolePermission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Create Admin Role
        $adminRole = UserRole::create([
            'role_name' => 'Admin',
            'description' => 'Administrator with full access',
        ]);

        // Assign permissions to Admin
        RolePermission::create(['role_id' => $adminRole->role_id, 'description' => 'Create']);
        RolePermission::create(['role_id' => $adminRole->role_id, 'description' => 'Retrieve']);
        RolePermission::create(['role_id' => $adminRole->role_id, 'description' => 'Update']);
        RolePermission::create(['role_id' => $adminRole->role_id, 'description' => 'Delete']);

        // Create User Role
        $userRole = UserRole::create([
            'role_name' => 'User',
            'description' => 'Regular user with limited access',
        ]);

        // Assign permissions to User
        RolePermission::create(['role_id' => $userRole->role_id, 'description' => 'Create']);
        RolePermission::create(['role_id' => $userRole->role_id, 'description' => 'Retrieve']);
    }
}