<?php
Route::get('/', function () {
    return view('welcome');
});
// quasi tutti verbi sono get perche ci sara un form apparte per gestire le richieste
Route::post('/edifici','EdificiController@store');
Route::get('/edifici','EdificiController@index');
Route::get('/edifici/delete','EdificiController@delete');
Route::get('/edifici/create','EdificiController@create');
Route::get('/edifici/{edificio}','EdificiController@show');
Route::get('/edifici/{edificio}/edit','EdificiController@edit');
Route::put('/edifici/{edificio}','EdificiController@update');

Route::post('/edifici/{edificio}/aule/','AuleController@store');
Route::get('/edifici/{edificio}/aule/create','AuleController@create');
Route::get('/edifici/{edificio}/aule/delete','AuleController@delete');
Route::get('/edifici/{edificio}/aule','AuleController@index');
Route::get('/edifici/{edificio}/aule/{aula}/edit','AuleController@edit');        // apre/chiude aula se addetto modifica se admin
Route::get('/edifici/{edificio}/aule/{aula}','AuleController@show');
Route::put('/edifici/{edificio}/aule/{aula}','AuleController@update');

Route::post('/edificio/{edificio}/mappe/{mappa}','MappeController@store');
Route::get('/edificio/{edificio}/mappe','MappeController@index');
Route::get('/edificio/{edificio}/mappe/create','MappeController@create');
Route::get('/edificio/{edificio}/mappe/delete','MappeController@delete');
Route::get('/edificio/{edificio}/mappe/{mappa}','MappeController@show');
Route::get('/edificio/{edificio}/mappe/{mappa}/edit','MappeController@edit');
Route::put('/edificio/{edificio}/mappe/{mappa}','MappeController@update');

Route::post('/prenotazioni','PrenotazioniController@store');
Route::get('/prenotazioni','PrenotazioniController@index');
Route::get('/prenotazioni/{prenotazione}','PrenotazioniController@show');
Route::get('/prenotazioni/{prenotazione}/edit','PrenotazioniController@edit');
Route::get('/prenotazini/delete','PrenotazioniController@delete');
Route::get('/prenotazioni/create','PrenotazioniController@create');
Route::put('/prenotazioni/{prenotazione}','PrenotazioniController@update');
Route::get('/check',function() {
    return view('check');
});
?>
