<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::whereGuardName('admin')->get();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
//        $user_permissions = $admin_permissions->filter(function ($permission) {
//            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
//        });
//        Role::findOrFail(2)->permissions()->sync($user_permissions);
//        Role::findOrFail(3)->permissions()->sync($user_permissions);

        $merchant_permission = Permission::whereGuardName('user')->get();
        $agent_permissions = Permission::whereGuardName('user')->get();


        Role::findOrFail(2)->permissions()->sync($merchant_permission);
        Role::findOrFail(3)->permissions()->sync($agent_permissions);
    }
}
