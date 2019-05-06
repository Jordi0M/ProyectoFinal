<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
/*
Route::get('/', function () {
    return view('welcome');
    return  Auth::user()->id ;
});
*/
/*
Route::group(['middleware' => ['auth']], function () {
    //only authorized users can access these routes
});

Route::group(['middleware' => ['guest']], function () {
    //only guests can access these routes
});
*/

    /*
Route::get('/', function () {
    //return redirect()->intended('dashboard');
    if (Auth::guest()) {
        return redirect()->action('AudiosController@index_auntenticado');
        //return redirect('/index');
    }
    else {
        return redirect()->action('AudiosController@index_auntenticado');
        //return redirect('/index');
    }
});
*/

//Route::get('/index/{id?}','AudiosController@index_auntenticado')->middleware('auth');
//Route::get('/index','AudiosController@index');
//Route::get('/index','AudiosController@index')->middleware('guest');

Auth::routes();

//Route::get('/','AudiosController@index')->middleware('guest');
//Route::get('/','AudiosController@index_auntenticado')->middleware('auth');

Route::get('/','AudiosController@index');
//Route::get('/{id?}','AudiosController@index_auntenticado');

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/logout', '\App\Http\Controllers\Auth\LoginController@logout');

Route::get('/nuevo_sonido/{id}','AudiosController@index_auntenticado');
Route::post('/nuevo_sonido/{id}', 'AudiosController@nuevoSonido');
