<?php

Route::group(['prefix' => 'v1', 'as' => 'api.', 'namespace' => 'Api\V1\Admin', 'middleware' => ['auth:sanctum']], function () {
    // Hospital
    Route::post('hospitals/media', 'HospitalApiController@storeMedia')->name('hospitals.storeMedia');
    Route::apiResource('hospitals', 'HospitalApiController');

    // Patient
    Route::apiResource('patients', 'PatientApiController');

    // Surgery
    Route::apiResource('surgeries', 'SurgeryApiController');

    // Disease
    Route::apiResource('diseases', 'DiseaseApiController');

    // Vaccine
    Route::apiResource('vaccines', 'VaccineApiController');

    // Allergy
    Route::apiResource('allergies', 'AllergyApiController');
});
