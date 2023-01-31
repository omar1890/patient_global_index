<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\Role;
use Illuminate\Database\Seeder;

class PermissionRoleTableSeeder extends Seeder
{
    public function run()
    {
        $admin_permissions = Permission::all();
        Role::findOrFail(1)->permissions()->sync($admin_permissions->pluck('id'));
        $user_permissions = $admin_permissions->filter(function ($permission) {
            return substr($permission->title, 0, 5) != 'user_' && substr($permission->title, 0, 5) != 'role_' && substr($permission->title, 0, 11) != 'permission_';
        });
        Role::findOrFail(2)->permissions()->sync($user_permissions);
        $patient_permissions = Permission::whereIn('title', [
            'profile_password_edit',
            'patient_edit',
            'patient_show',
            'patient_access',
            'patient_record_access',

            'surgery_create',
            'surgery_edit',
            'surgery_show',
            'surgery_delete',
            'surgery_access',

            'disease_create',
            'disease_edit',
            'disease_show',
            'disease_delete',
            'disease_access',

            'vaccine_create',
            'vaccine_edit',
            'vaccine_show',
            'vaccine_delete',
            'vaccine_access',

            'allergy_create',
            'allergy_edit',
            'allergy_show',
            'allergy_delete',
            'allergy_access',

            'patient_medicine_create',
            'patient_medicine_edit',
            'patient_medicine_show',
            'patient_medicine_delete',
            'patient_medicine_access',

            'patient_visit_show',
            'patient_visit_access',
        ])->get();
        Role::findOrFail(3)->permissions()->sync($patient_permissions);
    }
}
