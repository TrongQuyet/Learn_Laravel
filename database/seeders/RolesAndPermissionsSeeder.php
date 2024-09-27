<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\Hash;

class RolesAndPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        Permission::create(['guard_name' => 'api', 'name' => 'create contracts']);
        Permission::create(['guard_name' => 'api', 'name' => 'update contracts']);
        Permission::create(['guard_name' => 'api', 'name' => 'delete contracts']);

        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();

        $editorRole = Role::create(['guard_name' => 'api', 'name' => 'editor'])
            ->givePermissionTo(['create contracts', 'update contracts']);

        $adminRole = Role::create(['guard_name' => 'api', 'name' => 'admin'])->givePermissionTo(Permission::all());

        $admin = User::firstOrCreate([
            'email' => 'super.quyet69@gmail.com',
        ], [
            'name' => 'Admin',
            'email' => 'super.quyet69@gmail.com',
            'password' => Hash::make ('12345678'),
        ]);

        $admin->assignRole($adminRole);

        $editor = User::firstOrCreate([
                    'email' => 'quyet30052001@gmail.com'
                ], [
                    'name' => 'editor',
                    'email' => 'quyet30052001@gmail.com',
                    'password' => Hash::make ('12345678'),
                ]);

        $editor->assignRole($editorRole);
    }
}
