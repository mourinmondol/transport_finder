<?php


Route::get('/', 'FrontendController@index')->name('index');
Route::get('/search', 'FrontendController@search')->name('search');
Route::get('/about', 'FrontendController@about')->name('about');
Route::get('/docs', 'FrontendController@docs')->name('docs');
Route::get('/contact', 'FrontendController@contact')->name('contact');
Route::get('/transport_profile', 'FrontendController@transport_profile')->name('transport_profile');
Route::get('/station_profile', 'FrontendController@station_profile')->name('station_profile');
Route::get('/search_route', 'FrontendController@search_route')->name('search_route');
Route::get('/search_result', 'FrontendController@search_result')->name('search_result');
Route::get('/give_feedback', 'FrontendController@give_feedback')->name('give_feedback');

Auth::routes();

Route::prefix('user')->group(function() {
    Route::get('/home', 'HomeController@index')->name('home');

    Route::get('/transport', 'user\TransportController@index')->name('user.transport');
    Route::post('/store/transport', 'user\TransportController@store')->name('user.store.transport');
    Route::get('/transport/edit/{id}',[
        'uses' => 'user\TransportController@edit',
        'as' => 'transport_edit_user'
    ]);
    
    Route::post('/transport/update/{id}',[
        'uses' => 'user\TransportController@update',
        'as' => 'transport_update_user'
    ]);
    
    Route::get('/transport/delete/{id}',[
        'uses' => 'user\TransportController@destroy',
        'as' => 'transport_delete_user'
    ]);

    Route::get('/station', 'user\StationController@index')->name('user.station');
    Route::post('/store/station', 'user\StationController@store')->name('user.store.station');
    Route::get('/station/edit/{id}',[
        'uses' => 'user\StationController@edit',
        'as' => 'station_edit_user'
    ]);
    
    Route::post('/station/update/{id}',[
        'uses' => 'user\StationController@update',
        'as' => 'station_update_user'
    ]);
    
    Route::get('/station/delete/{id}',[
        'uses' => 'user\StationController@destroy',
        'as' => 'station_delete_user'
    ]);

    Route::get('/route', 'user\RouteController@index')->name('user.route');
    Route::post('/store/route', 'user\RouteController@store')->name('user.store.route');
    Route::get('/route/edit/{id}',[
        'uses' => 'user\RouteController@edit',
        'as' => 'route_edit_user'
    ]);
    
    Route::post('/route/update/{id}',[
        'uses' => 'user\RouteController@update',
        'as' => 'route_update_user'
    ]);
    
    Route::get('/route/delete/{id}',[
        'uses' => 'user\RouteController@destroy',
        'as' => 'route_delete_user'
    ]);

    Route::get('/feedback', 'user\FeedbackController@index')->name('user.feedback');
    Route::post('/store/feedback', 'user\FeedbackController@store')->name('user.store.feedback');
    Route::get('/feedback/edit/{id}',[
        'uses' => 'user\FeedbackController@edit',
        'as' => 'feedback_edit_user'
    ]);
    
    Route::post('/feedback/update/{id}',[
        'uses' => 'user\FeedbackController@update',
        'as' => 'feedback_update_user'
    ]);
    
    Route::get('/feedback/delete/{id}',[
        'uses' => 'user\FeedbackController@destroy',
        'as' => 'feedback_delete_user'
    ]);

    Route::get('/profile', 'user\ProfileController@index')->name('user.profile');
    Route::post('/store/profile', 'user\ProfileController@store')->name('user.store.profile');
    Route::get('/profile/edit/{id}',[
        'uses' => 'user\ProfileController@edit',
        'as' => 'profile_edit_user'
    ]);
    
    Route::post('/profile/update/{id}',[
        'uses' => 'user\ProfileController@update',
        'as' => 'profile_update_user'
    ]);
    
    Route::get('/profile/delete/{id}',[
        'uses' => 'user\ProfileController@destroy',
        'as' => 'profile_delete_user'
    ]);
});
Route::group(['prefix' => 'admin', 'middleware' => ['web']], function () {
    Route::get('/', 'Auth\AdminLoginController@showLoginForm')->name('admin.login');
    Route::post('/login', 'Auth\AdminLoginController@login')->name('admin.login.submit');
    Route::get('/home', 'AdminController@index')->name('admin.home');

    Route::get('/transport', 'TransportController@index')->name('admin.transport');
    Route::post('/store/transport', 'TransportController@store')->name('admin.store.transport');
    Route::get('/transport/edit/{id}',[
        'uses' => 'TransportController@edit',
        'as' => 'transport_edit'
    ]);
    
    Route::post('/transport/update/{id}',[
        'uses' => 'TransportController@update',
        'as' => 'transport_update'
    ]);
    
    Route::get('/transport/delete/{id}',[
        'uses' => 'TransportController@destroy',
        'as' => 'transport_delete'
    ]);
    

    Route::get('/stations', 'StationController@index')->name('admin.station');
    Route::post('/store/stations', 'StationController@store')->name('admin.store.station');
    Route::get('/station/edit/{id}',[
        'uses' => 'StationController@edit',
        'as' => 'station_edit'
    ]);
    
    Route::post('/station/update/{id}',[
        'uses' => 'StationController@update',
        'as' => 'station_update'
    ]);
    
    Route::get('/station/delete/{id}',[
        'uses' => 'StationController@destroy',
        'as' => 'station_delete'
    ]);
    


    Route::get('/routes', 'RouteController@index')->name('admin.route');
    Route::post('/store/routes', 'RouteController@store')->name('admin.store.route');
    Route::get('/route/edit/{id}',[
        'uses' => 'RouteController@edit',
        'as' => 'route_edit'
    ]);
    
    Route::post('/route/update/{id}',[
        'uses' => 'RouteController@update',
        'as' => 'route_update'
    ]);
    
    Route::get('/route/delete/{id}',[
        'uses' => 'RouteController@destroy',
        'as' => 'route_delete'
    ]);
    

    Route::get('/feedbacks', 'FeedbackController@index')->name('admin.feedback');
    Route::get('/feedback/edit/{id}',[
        'uses' => 'FeedbackController@edit',
        'as' => 'feedback_edit'
    ]);
    
    Route::post('/feedback/update/{id}',[
        'uses' => 'FeedbackController@update',
        'as' => 'feedback_update'
    ]);
    
    Route::get('/feedback/delete/{id}',[
        'uses' => 'FeedbackController@destroy',
        'as' => 'feedback_delete'
    ]);

    Route::get('/informations', 'InformationController@index')->name('admin.information');
    Route::post('/store/information', 'InformationController@store')->name('admin.store.information');
    Route::get('/information/edit/{id}',[
        'uses' => 'InformationController@edit',
        'as' => 'information_edit'
    ]);
    
    Route::post('/information/update/{id}',[
        'uses' => 'InformationController@update',
        'as' => 'information_update'
    ]);
    
    Route::get('/information/delete/{id}',[
        'uses' => 'InformationController@destroy',
        'as' => 'information_delete'
    ]);

    Route::get('/users', 'UserController@index')->name('admin.user');
    Route::post('/store/user', 'UserController@store')->name('admin.store.user');
    Route::get('/user/edit/{id}',[
        'uses' => 'UserController@edit',
        'as' => 'user_edit'
    ]);
    
    Route::post('/user/update/{id}',[
        'uses' => 'UserController@update',
        'as' => 'user_update'
    ]);
    
    Route::get('/user/delete/{id}',[
        'uses' => 'UserController@destroy',
        'as' => 'user_delete'
    ]);

});