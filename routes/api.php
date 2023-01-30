<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Hospital
    Route::post('hospitals/media', 'HospitalApiController@storeMedia')->name('hospitals.storeMedia');
    Route::apiResource('hospitals', 'HospitalApiController');

    // Patient
    Route::post('patients/media', 'PatientApiController@storeMedia')->name('patients.storeMedia');
    Route::apiResource('patients', 'PatientApiController');

    // Surgery
    Route::apiResource('surgeries', 'SurgeryApiController');

    // Disease
    Route::apiResource('diseases', 'DiseaseApiController');

    // Vaccine
    Route::apiResource('vaccines', 'VaccineApiController');

    // Allergy
    Route::apiResource('allergies', 'AllergyApiController');

    // Medicine
    Route::apiResource('medicines', 'MedicineApiController');

    // Patient Medicine
    Route::apiResource('patient-medicines', 'PatientMedicineApiController');

    // Patient Visit
    Route::post('patient-visits/media', 'PatientVisitApiController@storeMedia')->name('patient-visits.storeMedia');
    Route::apiResource('patient-visits', 'PatientVisitApiController');
});
