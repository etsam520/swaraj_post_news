<?php

namespace Database\Seeders;

use App\CentralLogics\PermissionName as Pn;
use App\CentralLogics\RoleName;
use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $adminPermission = [
            Pn::VIEW_DASHBOARD,
            Pn::VIEW_USERS,
            Pn::CREATE_USERS,
            Pn::UPDATE_USERS,
            Pn::DELETE_USERS,
            Pn::UPDATE_ROLES,
            Pn::UPATE_PERMISSIONS,
            Pn::VIEW_CITIES,
            Pn::CREATE_CITIES,
            Pn::UPDATE_CITIES,
            Pn::DELETE_CITIES,
            Pn::VIEW_TAGS,
            Pn::CREATE_TAGS,
            Pn::UPDATE_TAGS,
            Pn::DELETE_TAGS,
            Pn::VIEW_CATEGORIES,
            Pn::CREATE_CATEGORIES,
            Pn::UPDATE_CATEGORIES,
            Pn::DELETE_CATEGORIES,
            Pn::CREATE_NEWS,
            Pn::UPDATE_NEWS,
            Pn::DELETE_NEWS,
            Pn::VIEW_NEWS,
            Pn::APPROVE_NEWS,
            Pn::VIEW_VISUAL_STORIES,
            Pn::CREATE_VISUAL_STORIES,
            Pn::UPDATE_VISUAL_STORIES,
            Pn::DELETE_VISUAL_STORIES,
        ];

        foreach ($adminPermission as $permission) {
            Permission::create(['guard_name' => 'admin', 'name' => $permission]);
        }
        $super_admin_role = Role::create(['guard_name' => 'admin', 'name' => RoleName::SUPER_ADMIN]);
        $super_admin = Admin::where('email', 'superadmin@email.com')->first();
        $super_admin->syncRoles($super_admin_role);

        // Create permissions for the admin role

        $admin_role = Role::create(['guard_name' => 'admin', 'name' => 'admin']);
        $admin_role->syncPermissions($adminPermission);
        $admin = Admin::where('email', 'admin@email.com')->first();
        $admin->syncRoles($admin_role);

        // Create permissions for the manager role
        Role::create(['guard_name' => 'admin', 'name' => RoleName::MANAGER]);

        $reporder_role = Role::create(['guard_name' => 'admin', 'name' => RoleName::REPORTER]);
        $reporder_role->syncPermissions([
            Pn::VIEW_DASHBOARD,
            Pn::VIEW_USERS,
            Pn::VIEW_CITIES,
            Pn::VIEW_TAGS,
            Pn::CREATE_TAGS,
            Pn::UPDATE_TAGS,
            Pn::DELETE_TAGS,
            Pn::VIEW_CATEGORIES,

        ]);

    }
}
