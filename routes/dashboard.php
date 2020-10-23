<?php

Route::get('/', 'DashboardController@index')->name('dashboard');

// Admins Only Routes
Route::middleware('admin')->group(function () {
    // Settings Routes
    Route::group([], function () { 
        Route::get('/delete-media', 'SettingsController@deleteMedia')->name('settings.media.destroy');
        Route::get('/settings', 'SettingsController@show')->name('settings.show');
        Route::post('/settings', 'SettingsController@store')->name('settings.store');
    });
    
    // Users Routes
    Route::group([], function () {
        Route::delete('/destroy-group', 'UsersController@destroyGroup')->name('users.destroyGroup');
        
        // trashed routes
        Route::get('/trashed', 'UsersController@trashed')->name('users.trashed');
        Route::patch('/{id}/restore', 'UsersController@restore')->name('users.restore');
        Route::delete('/{id}/force_delete', 'UsersController@forceDelete')->name('users.force_delete');
        
        // Update Password
        Route::patch('/{user}/update-password', 'UsersController@updatePassword')->name('users.update.password');
        
        // Resource Routes
        Route::resource('/users', 'UsersController');
    });
    
 

    
    // Categories Routes
    Route::group([], function () {
        // Multi Delete Route
        Route::delete('/categories/destroy-group', 'CategoriesController@destroyGroup')->name('categories.destroyGroup');
    
        // trashed Routes
        Route::get('/categories/trashed', 'CategoriesController@trashed')->name('categories.trashed');
        Route::patch('/categories/{id}/restore', 'CategoriesController@restore')->name('categories.restore');
        Route::delete('/categories/{id}/force_delete', 'CategoriesController@forceDelete')->name('categories.force_delete');
    
        // Resource Routes
        Route::resource('/categories', 'CategoriesController');
    });
        
    // Contacts Routes
    Route::group([], function () {
        Route::delete('/contacts/destroy-group', 'ContactsController@destroyGroup')->name('contacts.destroyGroup');
        Route::resource('/contacts', 'ContactsController');
    });


    // potfolios Routes
Route::group([], function () {  //portfolios
    // Media Delete Route
    Route::get('/portfolios/{portfolio}/destroy-media', 'PortfoliosController@destroyMedia')->name('portfolios.media.destroy');
    
    // Multi Delete Route
    Route::delete('/portfolios/destroy-group', 'PortfoliosController@destroyGroup')->name('portfolios.destroyGroup');

    // trashed Routes
    Route::get('/portfolios/trashed', 'PortfoliosController@trashed')->name('portfolios.trashed');
    Route::patch('/portfolios/{id}/restore', 'PortfoliosController@restore')->name('portfolios.restore');
    Route::delete('/portfolios/{id}/force_delete', 'PortfoliosController@forceDelete')->name('portfolios.force_delete');

    // Resource Routes
    Route::resource('/portfolios', 'PortfoliosController');
});



    // client Routes
    Route::group([], function () {  //clients
        // Media Delete Route
        Route::get('/clients/{client}/destroy-media', 'ClientsController@destroyMedia')->name('clients.media.destroy');
        
        // Multi Delete Route
        Route::delete('/clients/destroy-group', 'ClientsController@destroyGroup')->name('clients.destroyGroup');
    
        // trashed Routes
        Route::get('/clients/trashed', 'ClientsController@trashed')->name('clients.trashed');
        Route::patch('/clients/{id}/restore', 'ClientsController@restore')->name('clients.restore');
        Route::delete('/clients/{id}/force_delete', 'ClientsController@forceDelete')->name('clients.force_delete');
    
        // Resource Routes
        Route::resource('/clients', 'ClientsController');
        
    });

    



    // services Routes
    Route::group([], function () {  //portfolios
        // Media Delete Route
        Route::get('/services/{service}/destroy-media', 'ServicesController@destroyMedia')->name('services.media.destroy');
        
        // Multi Delete Route
        Route::delete('/services/destroy-group', 'ServicesController@destroyGroup')->name('services.destroyGroup');
    
        // trashed Routes
        Route::get('/services/trashed', 'ServicesController@trashed')->name('services.trashed');
        Route::patch('/services/{id}/restore', 'ServicesController@restore')->name('services.restore');
        Route::delete('/services/{id}/force_delete', 'ServicesController@forceDelete')->name('services.force_delete');
    
        // Resource Routes
        Route::resource('/services', 'ServicesController');
    
    });



    
    // course Routes
    Route::group([], function () {  //portfolios
        // Media Delete Route
        Route::get('/courses/{course}/destroy-media', 'CoursesController@destroyMedia')->name('courses.media.destroy');
        
        // Multi Delete Route
        Route::delete('/courses/destroy-group', 'CoursesController@destroyGroup')->name('courses.destroyGroup');
    
        // trashed Routes
        Route::get('/courses/trashed', 'CoursesController@trashed')->name('courses.trashed');
        Route::patch('/courses/{id}/restore', 'CoursesController@restore')->name('courses.restore');
        Route::delete('/courses/{id}/force_delete', 'CoursesController@forceDelete')->name('courses.force_delete');
    
        // Resource Routes
        Route::resource('/courses', 'CoursesController');
    
    });

});



 

