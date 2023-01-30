<?php

Route::get('/test',function (\Request $request) {
    // return \Config::get('app.url');
    return request()->header('Host');
});

Route::redirect('/', '/login');
Route::get('/home', function () {
    if (session('status')) {
        return redirect()->route('admin.home')->with('status', session('status'));
    }

    return redirect()->route('admin.home');
});

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
