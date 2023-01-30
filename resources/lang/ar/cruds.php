<?php

return [
    'userManagement' => [
        'title'          => 'إدارة المستخدمين',
        'title_singular' => 'إدارة المستخدمين',
    ],
    'permission' => [
        'title'          => 'الصلاحيات',
        'title_singular' => 'الصلاحية',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'title'             => 'Title',
            'title_helper'      => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'role' => [
        'title'          => 'المجموعات',
        'title_singular' => 'مجموعة',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'title'              => 'Title',
            'title_helper'       => ' ',
            'permissions'        => 'Permissions',
            'permissions_helper' => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'user' => [
        'title'          => 'المستخدمين',
        'title_singular' => 'مستخدم',
        'fields'         => [
            'id'                       => 'ID',
            'id_helper'                => ' ',
            'name'                     => 'Name',
            'name_helper'              => ' ',
            'email'                    => 'Email',
            'email_helper'             => ' ',
            'email_verified_at'        => 'Email verified at',
            'email_verified_at_helper' => ' ',
            'password'                 => 'Password',
            'password_helper'          => ' ',
            'roles'                    => 'Roles',
            'roles_helper'             => ' ',
            'remember_token'           => 'Remember Token',
            'remember_token_helper'    => ' ',
            'created_at'               => 'Created at',
            'created_at_helper'        => ' ',
            'updated_at'               => 'Updated at',
            'updated_at_helper'        => ' ',
            'deleted_at'               => 'Deleted at',
            'deleted_at_helper'        => ' ',
            'mobile'                   => 'Mobile',
            'mobile_helper'            => ' ',
            'identity_number'          => 'Identity Number',
            'identity_number_helper'   => ' ',
        ],
    ],
    'hospital' => [
        'title'          => 'Hospital',
        'title_singular' => 'Hospital',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'admin'             => 'Admin',
            'admin_helper'      => 'hospital admin',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'address'           => 'Address',
            'address_helper'    => ' ',
            'license'           => 'License',
            'license_helper'    => 'hospital license or a paper prove you are the hospital owner',
        ],
    ],
    'patient' => [
        'title'          => 'Patient',
        'title_singular' => 'Patient',
        'fields'         => [
            'id'                        => 'ID',
            'id_helper'                 => ' ',
            'smoking'                   => 'Smoking',
            'smoking_helper'            => ' ',
            'weight'                    => 'Weight',
            'weight_helper'             => ' ',
            'blood_type'                => 'Blood Type',
            'blood_type_helper'         => ' ',
            'height'                    => 'Height',
            'height_helper'             => ' ',
            'avg_blood_pressure'        => 'Average Blood Pressure',
            'avg_blood_pressure_helper' => ' ',
            'user'                      => 'User',
            'user_helper'               => ' ',
            'created_at'                => 'Created at',
            'created_at_helper'         => ' ',
            'updated_at'                => 'Updated at',
            'updated_at_helper'         => ' ',
            'deleted_at'                => 'Deleted at',
            'deleted_at_helper'         => ' ',
            'name'                      => 'Name',
            'name_helper'               => ' ',
            'identity_number'           => 'Identity Number',
            'identity_number_helper'    => ' ',
            'documents'                 => 'Documents',
            'documents_helper'          => ' ',
        ],
    ],
    'surgery' => [
        'title'          => 'Surgery',
        'title_singular' => 'Surgery',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'reason'             => 'Reason',
            'reason_helper'      => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'type'               => 'Type',
            'type_helper'        => ' ',
            'doctor_name'        => 'Doctor Name',
            'doctor_name_helper' => ' ',
            'date'               => 'Date',
            'date_helper'        => ' ',
            'patient'            => 'Patient',
            'patient_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'patientRecord' => [
        'title'          => 'Patient Records',
        'title_singular' => 'Patient Record',
    ],
    'disease' => [
        'title'          => 'Disease',
        'title_singular' => 'Disease',
        'fields'         => [
            'id'                     => 'ID',
            'id_helper'              => ' ',
            'name'                   => 'Name',
            'name_helper'            => ' ',
            'description'            => 'Description',
            'description_helper'     => ' ',
            'is_chronic'             => 'Chronic',
            'is_chronic_helper'      => ' ',
            'is_from_parents'        => 'Is Hereditary disease',
            'is_from_parents_helper' => ' ',
            'patient'                => 'Patient',
            'patient_helper'         => ' ',
            'created_at'             => 'Created at',
            'created_at_helper'      => ' ',
            'updated_at'             => 'Updated at',
            'updated_at_helper'      => ' ',
            'deleted_at'             => 'Deleted at',
            'deleted_at_helper'      => ' ',
        ],
    ],
    'vaccine' => [
        'title'          => 'Vaccine',
        'title_singular' => 'Vaccine',
        'fields'         => [
            'id'                      => 'ID',
            'id_helper'               => ' ',
            'name'                    => 'Name',
            'name_helper'             => ' ',
            'start_date'              => 'Start Date',
            'start_date_helper'       => ' ',
            'end_date'                => 'End Date',
            'end_date_helper'         => ' ',
            'times_vaccinated'        => 'Number of times vaccinated',
            'times_vaccinated_helper' => ' ',
            'is_annual'               => 'Is Annual',
            'is_annual_helper'        => ' ',
            'patient'                 => 'Patient',
            'patient_helper'          => ' ',
            'created_at'              => 'Created at',
            'created_at_helper'       => ' ',
            'updated_at'              => 'Updated at',
            'updated_at_helper'       => ' ',
            'deleted_at'              => 'Deleted at',
            'deleted_at_helper'       => ' ',
        ],
    ],
    'allergy' => [
        'title'          => 'Allergy',
        'title_singular' => 'Allergy',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'name'               => 'Name',
            'name_helper'        => ' ',
            'description'        => 'Description',
            'description_helper' => ' ',
            'patient'            => 'Patient',
            'patient_helper'     => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
        ],
    ],
    'medicine' => [
        'title'          => 'Medicine',
        'title_singular' => 'Medicine',
        'fields'         => [
            'id'                => 'ID',
            'id_helper'         => ' ',
            'name'              => 'Name',
            'name_helper'       => ' ',
            'type'              => 'Type',
            'type_helper'       => ' ',
            'created_at'        => 'Created at',
            'created_at_helper' => ' ',
            'updated_at'        => 'Updated at',
            'updated_at_helper' => ' ',
            'deleted_at'        => 'Deleted at',
            'deleted_at_helper' => ' ',
        ],
    ],
    'patientMedicine' => [
        'title'          => 'Patient Medicine',
        'title_singular' => 'Patient Medicine',
        'fields'         => [
            'id'                   => 'ID',
            'id_helper'            => ' ',
            'medicine'             => 'Medicine',
            'medicine_helper'      => ' ',
            'patient'              => 'Patient',
            'patient_helper'       => ' ',
            'created_at'           => 'Created at',
            'created_at_helper'    => ' ',
            'updated_at'           => 'Updated at',
            'updated_at_helper'    => ' ',
            'deleted_at'           => 'Deleted at',
            'deleted_at_helper'    => ' ',
            'patient_visit'        => 'Patient Visit',
            'patient_visit_helper' => ' ',
            'dose'                 => 'Dose',
            'dose_helper'          => ' ',
            'start_date'           => 'Start Date',
            'start_date_helper'    => ' ',
            'end_date'             => 'End Date',
            'end_date_helper'      => ' ',
            'is_continuous'        => 'Is Continuous',
            'is_continuous_helper' => ' ',
        ],
    ],
    'patientVisit' => [
        'title'          => 'Patient Visit',
        'title_singular' => 'Patient Visit',
        'fields'         => [
            'id'                 => 'ID',
            'id_helper'          => ' ',
            'hospital'           => 'Hospital',
            'hospital_helper'    => ' ',
            'patient'            => 'Patient',
            'patient_helper'     => ' ',
            'doctor_name'        => 'Doctor Name',
            'doctor_name_helper' => ' ',
            'diagnosis'          => 'Diagnosis',
            'diagnosis_helper'   => ' ',
            'date'               => 'Date',
            'date_helper'        => ' ',
            'division'           => 'Division',
            'division_helper'    => ' ',
            'created_at'         => 'Created at',
            'created_at_helper'  => ' ',
            'updated_at'         => 'Updated at',
            'updated_at_helper'  => ' ',
            'deleted_at'         => 'Deleted at',
            'deleted_at_helper'  => ' ',
            'documents'          => 'Documents',
            'documents_helper'   => ' ',
        ],
    ],
];
