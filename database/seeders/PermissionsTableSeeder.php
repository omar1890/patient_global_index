<?php

namespace Database\Seeders;

use App\Models\Permission;
use Illuminate\Database\Seeder;

class PermissionsTableSeeder extends Seeder
{
    public function run()
    {
        $permissions = [
            [
                'id'    => 1,
                'title' => 'user_management_access',
            ],
            [
                'id'    => 2,
                'title' => 'permission_create',
            ],
            [
                'id'    => 3,
                'title' => 'permission_edit',
            ],
            [
                'id'    => 4,
                'title' => 'permission_show',
            ],
            [
                'id'    => 5,
                'title' => 'permission_delete',
            ],
            [
                'id'    => 6,
                'title' => 'permission_access',
            ],
            [
                'id'    => 7,
                'title' => 'role_create',
            ],
            [
                'id'    => 8,
                'title' => 'role_edit',
            ],
            [
                'id'    => 9,
                'title' => 'role_show',
            ],
            [
                'id'    => 10,
                'title' => 'role_delete',
            ],
            [
                'id'    => 11,
                'title' => 'role_access',
            ],
            [
                'id'    => 12,
                'title' => 'user_create',
            ],
            [
                'id'    => 13,
                'title' => 'user_edit',
            ],
            [
                'id'    => 14,
                'title' => 'user_show',
            ],
            [
                'id'    => 15,
                'title' => 'user_delete',
            ],
            [
                'id'    => 16,
                'title' => 'user_access',
            ],
            [
                'id'    => 17,
                'title' => 'hospital_create',
            ],
            [
                'id'    => 18,
                'title' => 'hospital_edit',
            ],
            [
                'id'    => 19,
                'title' => 'hospital_show',
            ],
            [
                'id'    => 20,
                'title' => 'hospital_delete',
            ],
            [
                'id'    => 21,
                'title' => 'hospital_access',
            ],
            [
                'id'    => 22,
                'title' => 'patient_create',
            ],
            [
                'id'    => 23,
                'title' => 'patient_edit',
            ],
            [
                'id'    => 24,
                'title' => 'patient_show',
            ],
            [
                'id'    => 25,
                'title' => 'patient_delete',
            ],
            [
                'id'    => 26,
                'title' => 'patient_access',
            ],
            [
                'id'    => 27,
                'title' => 'surgery_create',
            ],
            [
                'id'    => 28,
                'title' => 'surgery_edit',
            ],
            [
                'id'    => 29,
                'title' => 'surgery_show',
            ],
            [
                'id'    => 30,
                'title' => 'surgery_delete',
            ],
            [
                'id'    => 31,
                'title' => 'surgery_access',
            ],
            [
                'id'    => 32,
                'title' => 'patient_record_access',
            ],
            [
                'id'    => 33,
                'title' => 'disease_create',
            ],
            [
                'id'    => 34,
                'title' => 'disease_edit',
            ],
            [
                'id'    => 35,
                'title' => 'disease_show',
            ],
            [
                'id'    => 36,
                'title' => 'disease_delete',
            ],
            [
                'id'    => 37,
                'title' => 'disease_access',
            ],
            [
                'id'    => 38,
                'title' => 'vaccine_create',
            ],
            [
                'id'    => 39,
                'title' => 'vaccine_edit',
            ],
            [
                'id'    => 40,
                'title' => 'vaccine_show',
            ],
            [
                'id'    => 41,
                'title' => 'vaccine_delete',
            ],
            [
                'id'    => 42,
                'title' => 'vaccine_access',
            ],
            [
                'id'    => 43,
                'title' => 'allergy_create',
            ],
            [
                'id'    => 44,
                'title' => 'allergy_edit',
            ],
            [
                'id'    => 45,
                'title' => 'allergy_show',
            ],
            [
                'id'    => 46,
                'title' => 'allergy_delete',
            ],
            [
                'id'    => 47,
                'title' => 'allergy_access',
            ],
            [
                'id'    => 48,
                'title' => 'medicine_create',
            ],
            [
                'id'    => 49,
                'title' => 'medicine_edit',
            ],
            [
                'id'    => 50,
                'title' => 'medicine_show',
            ],
            [
                'id'    => 51,
                'title' => 'medicine_delete',
            ],
            [
                'id'    => 52,
                'title' => 'medicine_access',
            ],
            [
                'id'    => 53,
                'title' => 'patient_medicine_create',
            ],
            [
                'id'    => 54,
                'title' => 'patient_medicine_edit',
            ],
            [
                'id'    => 55,
                'title' => 'patient_medicine_show',
            ],
            [
                'id'    => 56,
                'title' => 'patient_medicine_delete',
            ],
            [
                'id'    => 57,
                'title' => 'patient_medicine_access',
            ],
            [
                'id'    => 58,
                'title' => 'patient_visit_create',
            ],
            [
                'id'    => 59,
                'title' => 'patient_visit_edit',
            ],
            [
                'id'    => 60,
                'title' => 'patient_visit_show',
            ],
            [
                'id'    => 61,
                'title' => 'patient_visit_delete',
            ],
            [
                'id'    => 62,
                'title' => 'patient_visit_access',
            ],
            [
                'id'    => 63,
                'title' => 'profile_password_edit',
            ],
        ];

        Permission::insert($permissions);
    }
}
