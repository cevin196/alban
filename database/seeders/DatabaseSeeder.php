<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'admin',
            'email' => 'admin@mail.com',
            'phone_number' => '0811223344',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi',
        ]);
        User::factory(50)->create();

        // // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $permissions = [
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
            'role_create',
            'role_edit',
            'role_show',
            'role_delete',
            'role_access',
            'permission_create',
            'permission_edit',
            'permission_show',
            'permission_delete',
            'permission_access',
        ];
        // create permissions
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission
            ]);
        }
        // create roles and assign created permissions
        $roles = [
            'admin',
            'customer',
            'super-admin',
        ];

        foreach ($roles as $role) {
            Role::create(['name' => $role]);
        }

        $admin = Role::where('name', 'admin')->first();
        $admin->givePermissionTo([
            'user_create',
            'user_edit',
            'user_show',
            'user_delete',
            'user_access',
        ]);

        $superAdmin = Role::where('name', 'super-admin')->first();
        $superAdmin->givePermissionTo(Permission::all());

        $superAdmin->givePermissionTo(Permission::all());

        // assign default user with role
        User::find(1)->assignRole('super-admin');
        User::find(2)->assignRole('admin');
        User::find(3)->assignRole('customer');
    }
}
