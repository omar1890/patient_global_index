<?php

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

Route::get('/login/patient', 'Auth\PatientLoginController@loginView')->name('view.patient.login');
Route::post('/login/patient', 'Auth\PatientLoginController@login')->name('patient.login');

Route::get('/register/patient', 'Auth\RegisterController@register')->name('view.patient.register');
Route::post('/register', 'Auth\RegisterController@create')->name('create.patient');

Auth::routes(['register' => false]);

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth']], function () {
    Route::get('/', 'HomeController@index')->name('home');
    // Permissions
    Route::delete('permissions/destroy', 'PermissionsController@massDestroy')->name('permissions.massDestroy');
    Route::resource('permissions', 'PermissionsController');

    // Roles
    Route::delete('roles/destroy', 'RolesController@massDestroy')->name('roles.massDestroy');
    Route::resource('roles', 'RolesController');

    // Users
    Route::delete('users/destroy', 'UsersController@massDestroy')->name('users.massDestroy');
    Route::resource('users', 'UsersController');

    // Hospital
    Route::delete('hospitals/destroy', 'HospitalController@massDestroy')->name('hospitals.massDestroy');
    Route::post('hospitals/media', 'HospitalController@storeMedia')->name('hospitals.storeMedia');
    Route::post('hospitals/ckmedia', 'HospitalController@storeCKEditorImages')->name('hospitals.storeCKEditorImages');
    Route::resource('hospitals', 'HospitalController');

    // Patient
    Route::delete('patients/destroy', 'PatientController@massDestroy')->name('patients.massDestroy');
    Route::post('patients/media', 'PatientController@storeMedia')->name('patients.storeMedia');
    Route::post('patients/ckmedia', 'PatientController@storeCKEditorImages')->name('patients.storeCKEditorImages');
    Route::resource('patients', 'PatientController');

    // Surgery
    Route::delete('surgeries/destroy', 'SurgeryController@massDestroy')->name('surgeries.massDestroy');
    Route::resource('surgeries', 'SurgeryController');

    // Disease
    Route::delete('diseases/destroy', 'DiseaseController@massDestroy')->name('diseases.massDestroy');
    Route::resource('diseases', 'DiseaseController');

    // Vaccine
    Route::delete('vaccines/destroy', 'VaccineController@massDestroy')->name('vaccines.massDestroy');
    Route::resource('vaccines', 'VaccineController');

    // Allergy
    Route::delete('allergies/destroy', 'AllergyController@massDestroy')->name('allergies.massDestroy');
    Route::resource('allergies', 'AllergyController');

    // Medicine
    Route::delete('medicines/destroy', 'MedicineController@massDestroy')->name('medicines.massDestroy');
    Route::resource('medicines', 'MedicineController');

    // Patient Medicine
    Route::delete('patient-medicines/destroy', 'PatientMedicineController@massDestroy')->name('patient-medicines.massDestroy');
    Route::resource('patient-medicines', 'PatientMedicineController');

    // Patient Visit
    Route::delete('patient-visits/destroy', 'PatientVisitController@massDestroy')->name('patient-visits.massDestroy');
    Route::post('patient-visits/media', 'PatientVisitController@storeMedia')->name('patient-visits.storeMedia');
    Route::post('patient-visits/ckmedia', 'PatientVisitController@storeCKEditorImages')->name('patient-visits.storeCKEditorImages');
    Route::resource('patient-visits', 'PatientVisitController');
});
Route::group(['prefix' => 'profile', 'as' => 'profile.', 'namespace' => 'Auth', 'middleware' => ['auth']], function () {
    // Change password
    if (file_exists(app_path('Http/Controllers/Auth/ChangePasswordController.php'))) {
        Route::get('password', 'ChangePasswordController@edit')->name('password.edit');
        Route::post('password', 'ChangePasswordController@update')->name('password.update');
        Route::post('profile', 'ChangePasswordController@updateProfile')->name('password.updateProfile');
        Route::post('profile/destroy', 'ChangePasswordController@destroy')->name('password.destroyProfile');
    }
});
