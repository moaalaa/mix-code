<?php

// Authentications Routes
Route::namespace('Auth')->group(function () {    
    Route::post('/login', 'ApiLoginController@login')->name('login');
    Route::post('/register', 'ApiRegisterController@register')->name('register');
    
    Route::middleware('auth:api')->group(function () {
        Route::post('/profile/update/logo', 'ProfileController@updateLogo')->name('profile.update.logo');
        Route::patch('/profile/update/password', 'ProfileController@updatePassword')->name('profile.update.password');
        Route::patch('/profile/update', 'ProfileController@updateProfile')->name('profile.update');
        Route::get('/profile/{user_id}', 'ProfileController@getCardByUserId')->name('profile.show.getCardByUserId');
        Route::get('/profile', 'ProfileController@profile')->name('profile');
        Route::post('/logout', 'ApiLogoutController@logout')->name('logout');

      //  Notifications Routes

       
    });
});


// Categories Routes
Route::group([], function () {
    Route::get('/categories/{category}/cards', 'CategoriesController@cards')->name('categories.show.cards');
    Route::get('/categories/{category}', 'CategoriesController@show')->name('categories.show');
    Route::get('/categories', 'CategoriesController@index')->name('categories.index');
});

// Features Routes
Route::group([], function () {
    Route::get('/companies/{company}', 'CompaniesController@show')->name('companies.show');
    Route::get('/companies', 'CompaniesController@index')->name('companies.index');
});

 

// cards Routes
Route::group([], function () {

    // Search and filter Routes
    Route::get('/search', 'CardController@search')->name('cards.search');

    Route::middleware('auth:api')->group(function () {
        
        // Favorite cards Routes
        Route::group([], function () {
             Route::post('/orders', 'OrdersController@store')->name('orders.store');

         });


       Route::group([], function () {
    Route::get('/notifications', 'ordersNotificationsController@showAll')->name('showAll');
    // Route::get('/notifications/mark-all-as-read', 'ordersNotificationsController@markAllAsRead')->name('notifications.mark_all_as_read');
    Route::get('/notifications/{notification}', 'ordersNotificationsController@show')->name('notifications.show');
    // Route::get('/notifications/{notification}/mark-as-read', 'NotificationsController@markAsRead')->name('notifications.mark_as_read');
    // Route::get('/notifications/{notification}/mark-as-unread', 'NotificationsController@markAsUnRead')->name('notifications.mark_as_unread');
});


         
     });

      Route::get('/cards/{card}/categories', 'CardsController@showCategories')->name('cards.show.categories');
    Route::get('/cards/{card}/companies', 'CardsController@showCompanies')->name('cards.show.companies');
     Route::get('/cards/{card}/media', 'CardsController@showMedia')->name('cards.show.media');
    
    Route::get('/cards/{card}', 'CardsController@show')->name('cards.show');
    Route::get('/cards', 'CardsController@index')->name('cards.index');
});


// General Data Routes
Route::get('/general', 'GeneralDataController@index')->name('general.index');

// Contacts Routes
Route::post('/contacts', 'ContactsController@store')->name('contacts.store');


// Route::namespace('Auth')->group(function () {
//     Route::get('/forget/password', 'ForgotPasswordController@sendResetLinkEmail')->name('sendResetLinkEmail');

//     // Contacts Routes
//     Route::post('/forget/password/reset', 'ResetPasswordController@reset')->name('reset');
// })  ;
