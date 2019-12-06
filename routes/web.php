<?php

// Route::redirect('/', '/login');
// Route::redirect('/home', '/admin');

use App\Http\Controllers\Admin\HomeController;

Auth::routes(['register' => false]);



Route::group(['namespace' => 'Frontend'], function () {

    Route::post('register', 'HomeController@registerUser')->name('register');

    Route::get('/', 'HomeController@index')->name('frontend-home');

    Route::get('/home', 'HomeController@index')->name('frontend-home');

    Route::get('/signup' , 'HomeController@Signup')->name('signup');

    Route::get('/services/{id?}', 'HomeController@services');

    Route::get('/signin', 'HomeController@signin')->name('signin');

    Route::get('services-detail/{id?}', 'ServicesController@getSubService');

    Route::get('services-details/{id?}', 'ServicesController@showSubServiceOnHomeServiceClick');


    Route::get('getSubService/{id}', 'ServicesController@getSubService');


    Route::get('checkout/{id?}', 'HomeController@checkout');

    Route::get('add-to-cart/{id?}', 'ServicesController@addToCart');

    Route::patch('update-cart', 'ServicesController@update');

    Route::delete('remove-from-cart', 'ServicesController@remove');

    Route::get('contact', 'HomeController@contact')->name('contact');

    Route::get('about', 'HomeController@about')->name('about');

    Route::get('term', 'HomeController@term')->name('term');

    Route::get('orders-detail', 'HomeController@ordersdetail')->name('orders-detail');

    Route::post('posts', 'HomeController@postPost')->name('posts.post');

    Route::post('contact-checkout', 'HomeController@checkcontact')->name('contact-checkout');

    Route::post('comments-post' , 'HomeController@commentspost');

    Route::post('uploadcnic', 'ServicesController@uploadcnic');


    Route::get('thanks', 'HomeController@thankyou')->name('thanks');

    Route::get('career', 'HomeController@career')->name('career');
    
    Route::get('/searchPackages', 'ServicesController@searchPackages')->name('searchPackages');




});

    Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'as' => 'admin.', 'namespace' => 'Admin', 'middleware' => ['auth'],  "middleware" => ["is_thisAdmin","auth"] ], function () {
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

    // Service Categories
    Route::delete('service-categories/destroy', 'ServiceCategoryController@massDestroy')->name('service-categories.massDestroy');
    Route::post('service-categories/media', 'ServiceCategoryController@storeMedia')->name('service-categories.storeMedia');
    Route::resource('service-categories', 'ServiceCategoryController');

    Route::post('service-categories-update/{id?}', 'ServiceCategoryController@revertMethod')->name('service-categories-update');




    // Facilities
    Route::delete('facilities/destroy', 'FacilityController@massDestroy')->name('facilities.massDestroy');
    Route::post('facilities/media', 'FacilityController@storeMedia')->name('facilities.storeMedia');
    Route::resource('facilities', 'FacilityController');

    // Sub Catagories
    Route::delete('sub-catagories/destroy', 'SubCatagoryController@massDestroy')->name('sub-catagories.massDestroy');
    Route::post('sub-catagories/media', 'SubCatagoryController@storeMedia')->name('sub-catagories.storeMedia');
    Route::resource('sub-catagories', 'SubCatagoryController');

    // Areas
    Route::delete('areas/destroy', 'AreasController@massDestroy')->name('areas.massDestroy');
    Route::resource('areas', 'AreasController');

    // Faq Categories
    Route::delete('faq-categories/destroy', 'FaqCategoryController@massDestroy')->name('faq-categories.massDestroy');
    Route::resource('faq-categories', 'FaqCategoryController');

    // Faq Questions
    Route::delete('faq-questions/destroy', 'FaqQuestionController@massDestroy')->name('faq-questions.massDestroy');
    Route::resource('faq-questions', 'FaqQuestionController');

    // Sub Services
    Route::delete('sub-services/destroy', 'SubServiceController@massDestroy')->name('sub-services.massDestroy');
    Route::post('sub-services/media', 'SubServiceController@storeMedia')->name('sub-services.storeMedia');
    Route::resource('sub-services', 'SubServiceController');

    // Feedback
    Route::resource('feedback', 'FeedbackController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Orders
    // Route::resource('orders', 'OrdersController', ['except' => ['create', 'store', 'edit', 'update', 'show', 'destroy']]);

    // Slider
    Route::resource('slider', 'SliderController');

    Route::get('orders','HomeController@order');

    Route::post('/changeOrderStatus/{id}', 'HomeController@changeOrderStatus')->name('changeOrderStatus');


    Route::get('header', 'HomeController@headerfooter')->name('header');

    Route::get('header/edit/{id}','HomeController@headerfooteredit')->name('headeredit');

    Route::post('header/update/{id}','HomeController@headerfooterupdate');

    Route::get('testimonials', 'HomeController@testimonials')->name('testimonials');

    Route::get('testimonials/edit/{id}','HomeController@testimonialsedit')->name('testimonials');

    Route::post('testimonials/update/{id}','HomeController@testimonialsupdate');

});
