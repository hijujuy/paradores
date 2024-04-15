<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = User::where('name', 'user')->first();
        $admin = User::where('name', 'admin')->first();
        $root = User::where('name', 'root')->first();

        $role_user = Role::create(['name' => 'user']);
        $role_admin = Role::create(['name' => 'admin']);
        $role_root = Role::create(['name' => 'root']);

        $user->assignRole($role_user);
        $admin->assignRole($role_admin);
        $root->assignRol($role_root);

        Permission::create(['name' => 'cashier.open'])->syncRoles([$role_root, $role_admin, $role_user]);
        Permission::create(['name' => 'cashier.close'])->syncRoles([$role_root, $role_admin, $role_user]);
        Permission::create(['name' => 'sale.create'])->syncRoles([$role_root, $role_admin, $role_user]);
        Permission::create(['name' => 'sale.list'])->syncRoles([$role_root, $role_admin, $role_user]);
        Permission::create(['name' => 'sale.edit'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'sale.delete'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'shop.create'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'shop.edit'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'category.create'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'category.edit'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'category.delete'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'product.create'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'product.edit'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'product.delete'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'cashier.create'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'client.create'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'client.edit'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'client.delete'])->syncRoles([$role_root, $role_admin]);
        Permission::create(['name' => 'security.access'])->syncRoles([$role_root, $role_admin]);
    }
}
