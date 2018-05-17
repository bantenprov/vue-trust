<?php

Route::group(['prefix' => 'vue-trust', 'middleware' => ['web','role:superadministrator']], function() {
    Route::get('demo', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@demo');

    Route::get('/role', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@roleIndex')->name('vue-trust.roleIndex');

    Route::post('/role/store', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@roleStore')->name('vue-trust.roleStore');

    Route::get('/role/{id}/show', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@roleShow')->name('vue-trust.roleShow');

    Route::get('/role/{id}/edit', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@roleEdit')->name('vue-trust.roleEdit');

    Route::put('/role/{id}/update', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@roleUpdate')->name('vue-trust.roleUpdate');

    Route::delete('/role/{id}/destroy', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@roleDestroy')->name('vue-trust.roleDestroy');

    Route::get('/permission', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@permissionIndex')->name('vue-trust.permissionIndex');

    Route::post('/permission/store', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@permissionStore')->name('vue-trust.permissionStore');

    Route::get('/permission/{id}/show', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@permissionShow')->name('vue-trust.permissionShow');

    Route::get('/permission/{id}/edit', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@permissionEdit')->name('vue-trust.permissionEdit');

    Route::get('/role/{id}/set-permission', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@setPermission')->name('vue-trust.setPermission');

    Route::post('/role/{id}/set-permission-store', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@setPermissionStore')->name('vue-trust.setPermissionStore');

    Route::post('/role/{id}/remove-permission-from-role', 'Bantenprov\VueTrust\Http\Controllers\VueTrustController@removePermissionFromRole')->name('vue-trust.removePermissionFromRole');

});
