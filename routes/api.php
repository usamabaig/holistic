<?php

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['namespace' => 'Api\V1\Admin'], function () {
    // Permissions
    Route::apiResource('permissions', 'PermissionsApiController');

    // Roles
    Route::apiResource('roles', 'RolesApiController');

    // Users
    Route::apiResource('users', 'UsersApiController');

    // Service Categories
    Route::post('service-categories/media', 'ServiceCategoryApiController@storeMedia')->name('service-categories.storeMedia');
    Route::apiResource('service-categories', 'ServiceCategoryApiController');

    // Facilities
    Route::post('facilities/media', 'FacilityApiController@storeMedia')->name('facilities.storeMedia');
    Route::apiResource('facilities', 'FacilityApiController');

    Route::get('getDescfacilities', 'FacilityApiController@descServices');
    Route::get('getAscfacilities', 'FacilityApiController@ascServices');

    Route::post('getFacilitiesByCategory', 'FacilityApiController@getServicesByCategory');

    // Sub Catagories
    Route::post('sub-catagories/media', 'SubCatagoryApiController@storeMedia')->name('sub-catagories.storeMedia');
    Route::apiResource('sub-catagories', 'SubCatagoryApiController');

    // Areas
    Route::apiResource('areas', 'AreasApiController');

    // Faq Categories
    Route::apiResource('faq-categories', 'FaqCategoryApiController');

    // Faq Questions
    Route::apiResource('faq-questions', 'FaqQuestionApiController');
    Route::post('getFAQs', 'FaqQuestionApiController@getFAQs');


    // Sub Services
    Route::post('sub-services/media', 'SubServiceApiController@storeMedia')->name('sub-services.storeMedia');
    Route::apiResource('sub-services', 'SubServiceApiController');
    Route::post('getSubServicesByService', 'SubServiceApiController@getSubServicesByService');

    // Orders
    Route::post('orderPlace', 'OrderApiController@orderPlace');
    Route::post('orderHistory', 'OrderApiController@orderHistory');

    // Comments
    Route::post('doComment', 'CommentApiController@doComment');
    Route::post('commentDetails', 'CommentApiController@commentHistory');
    
    //Slider
    Route::get('getSliders', 'SliderApiController@sliderImages');
    
    // Cnic
    Route::post('postCnicDetails', 'CnicApiController@postCnicDetails');
    
    //Update User
    Route::post('updateUserInfo', 'UsersApiController@updateUserInfo');



});
