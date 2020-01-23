<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::middleware(['api'])->group(function () {

 
    Route::get('/me', 'Auth\AuthController@me');
    
});



Route::options('/{path}', function(){
    return '';
})->where('path', '.*');


Route::post('/login', 'Auth\AuthController@login');
Route::post('/logout', 'Auth\AuthController@logout');
Route::post('/register', 'Auth\AuthController@register');




/**
 * Rotte per gli edifici
 */
Route::get('/edifici/{edificio}/delete','BuildingsController@destroy');               // Delete lo elimina

Route::get('/edifici','BuildingsController@index');                                   //Index mostra una lista di tutti gli edifici

Route::post('/edifici','BuildingsController@store');                                  //Store salva le modifiche all’edificio

Route::get('/edifici/{edificio}','BuildingsController@show');                         //Show mostra un edificio specifico

Route::put('/edifici/{edificio}','BuildingsController@update');                       //Update salva le modifiche

Route::get('/edifici/aule/{edificio}','BuildingsController@aule');





/**
 * Rotte per le aule
 */

Route::get('/aule','ClassroomsController@index');                                         //Restituisce una lista delle aule che appartengono a un edificio

Route::post('/aule','ClassroomsController@store');                                        //Salva la nuova aula

Route::get('/aule/{aula}','ClassroomsController@show');                                   // Mostra un’aula specifica in base all'id

Route::put('/aule/{aula}','ClassroomsController@update') ;                                //Salva le modifiche ad un’aula

Route::get('/aule/{aula}/delete','ClassroomsController@destroy');                         //Cancella l’aula

Route::get('/aula/{aula}', 'ClassroomsController@showNome');                              //Restitusce un'aula in base al nome

Route::patch('/aule/{aula}','ClassroomsController@stato');                               // apre/chiude aula

Route::get('/aule/{aula}/presenze', 'ClassroomsController@presenze');







/**
 * Rotte per le mappe
 */

Route::get('/mappe','MapsController@index');                                       //Restituisce una lista di tutte le mappe

Route::post('/mappe','MapsController@store');                                      //Salva la nuova mappa aggiunta

Route::post('/mappe/{edificio}/{piano}','MapsController@update');                   //Registra le modifiche alla mappa

Route::get('/mappe/{mappa}/delete','MapsController@destroy');                       //Cancella la mappa

Route::get('/mappe/{mappa}','MapsController@show');
//Mostra la mappa

Route::get('/mappe/{edificio}/{piano}','MapsController@show_mappa_edificio');





/**
 * Rotte per le prenotazioni
 */

Route::get('/prenotazioni','BookingsController@index');                         //Mostra tutte le prenotazioni

Route::post('/prenotazioni','BookingsController@store');         //Registra la nuova prenotazione

Route::get('/prenotazioni/{prenotazione}','BookingsController@show');           //Mostra una prenotazione

Route::patch('/prenotazioni/{prenotazione}','BookingsController@update');        //Registra le modifiche alla prenotazione

Route::get('/prenotazioni/{prenotazione}/delete','BookingsController@destroy');   //Elimina una prenotazione

Route::patch('/prenotazioni/{prenotazione}','BookingsController@stato');         // accetta/rifiuta prenotazione



/**
 * Rotte per i posti
 */

Route::get('/posti/aula/{id_aula}','SeatsController@index_aula');                                 //Mostra tutti i posti all'interno di un'aula

Route::get('/posti','SeatsController@index');

Route::post('/posti','SeatsController@store');                                          //crea il nuovo posto

Route::get('/posti/{id_posto}','SeatsController@show');                                 //Mostra un posto

Route::patch('/posti/{id_posto}','SeatsController@stato');

Route::put('/posti/{id_posto}','SeatsController@update');                               //Registra le modifiche al posto

Route::get('/posti/{id_posto}/delete','SeatsController@destroy');                        //Elimina una prenotazione


/**
 * Rotte per le presenze
 */

Route::get('/presenze','PresencesController@index');

Route::post('/presenze','PresencesController@store');

Route::get('/presenze/{presenza}','PresencesController@show');

Route::put('/presenze/{presenza}','PresencesController@update');

Route::get('/presenze/{presenza}/delete','PresencesController@destroy');

Route::patch('/presenze/{presenza}', 'PresencesController@uscita');


/**
 * Rotte per le occupazioni
 */

Route::get('/occupazioni','OccupationsController@index');

Route::post('/occupazioni','OccupationsController@store');

Route::get('/occupazioni/{occupazione}','OccupationsController@show');

Route::put('/occupazioni/{occupazione}','OccupationsController@update');

Route::get('/occupazioni/{occupazione}/delete','OccupationsController@destroy');

