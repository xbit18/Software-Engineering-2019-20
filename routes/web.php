<?php
Route::get('/', function () {
    return view('welcome');
});

Route::post('/homepage', 'LoginController@check');

// quasi tutti verbi sono get perche ci sara un form apparte per gestire le richieste
Route::post('/edifici','EdificiController@store');               //Store salva le modifiche all’edificio
Route::get('/edifici','EdificiController@index');                //Index mostra una lista di tutti gli edifici
Route::get('/edifici/{edificio}/delete','EdificiController@delete');
// Delete lo elimina
Route::get('/edifici/create','EdificiController@create');        //Create crea un form per creare un edificio
Route::get('/edifici/{edificio}','EdificiController@show');
//Show mostra un edificio specifico
Route::get('/edifici/{edificio}/edit','EdificiController@edit');
//Edit crea un form per modificare un edificio
Route::put('/edifici/{edificio}','EdificiController@update');    //Update salva le modifiche

Route::get('/aule/create','AuleController@create');
//Create crea un form per creare un’aula
Route::post('/aule','AuleController@store');
//Salva la nuova aula
Route::get('/aule/{aula}/delete','AuleController@delete');
//Cancella l’aula
Route::get('/aule/edifici/{edificio}','AuleController@index');
//Restituisce una lista delle aule che appartengono a un edificio
Route::get('/aule/{aula}/{stato}','AuleController@stato');
// apre/chiude aula
Route::get('/aule/{aula}/edit','AuleController@edit');
//Crea un form per modificare i dati di un’aula
Route::get('/aule/{aula}','AuleController@show');
// Mostra un’aula specifica
Route::put('/aule/{aula}','AuleController@update');
//Salva le modifiche ad un’aula
Route::post('/mappe/{edificio}/{piano}','MappeController@store');
//Salva la nuova mappa aggiunta
Route::get('/mappe','MappeController@index');
//Restituisce una lista di tutte le mappe
Route::get('/mappe/create','MappeController@create');
//Crea un form per aggiungere una mappa
Route::get('/mappe/{mappa}/delete','MappeController@delete');
//Cancella la mappa
Route::get('/mappe/{edificio}/{piano}','MappeController@show');
//Mostra la mappa del piano
Route::get('/mappe/{edificio}/{piano}/edit','MappeController@edit');
//Crea un form per modificare la mappa di un piano
Route::put('/mappe/{edificio}/{piano}','MappeController@update');
//Registra le modifiche alla mappa
Route::get('/prenotazioni/create','PrenotazioniController@create');
//Mostra un form per creare una nuova prenotazione
Route::post('/prenotazioni/{prenotazione}','PrenotazioniController@store');
//Registra la nuova prenotazione
Route::get('/prenotazioni','PrenotazioniController@index');
//Mostra tutte le prenotazioni
Route::get('/prenotazioni/{prenotazione}','PrenotazioniController@show');
//Mostra una prenotazione
Route::get('/prenotazini/{prenotazione}/delete','PrenotazioniController@delete');
//Elimina una prenotazione
Route::get('/prenotazioni/{prenotazione}/edit','PrenotazioniController@edit');
//Crea un form per modificare una prenotazione
Route::put('/prenotazioni/{prenotazione}','PrenotazioniController@update');
//Registra le modifiche alla prenotazione
Route::post('/checks', 'CheckController@store');
//Effettua check-in e check-out
Route::get('/checks', function () {
    return view('check');
});
?>
