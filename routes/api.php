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


Route::options('/{path}', function () {
    return '';
})->where('path', '.*');


Route::post('/login', 'LoginController@check');


/**
 * Rotte per gli building
 */

Route::get('/buildings', 'BuildingsController@index');                                   //Index mostra una lista di tutti gli building

Route::post('/buildings', 'BuildingsController@store');                                  //Store salva le modifiche all’building

Route::get('/buildings/{building}', 'BuildingsController@show');                         //Show mostra un building specifico

Route::put('/buildings/{building}', 'BuildingsController@update');                       //Update salva le modifiche

Route::get('/buildings/classrooms/{building}', 'BuildingsController@classrooms');

Route::get('/buildings/{building}/delete', 'BuildingsController@destroy');               // Delete lo elimina


/**
 * Rotte per le classrooms
 */

Route::get('/classrooms', 'ClassroomsController@index');                                         //Restituisce una lista delle classrooms che appartengono a un building

Route::post('/classrooms', 'ClassroomsController@store');                                        //Salva la nuova classroom

Route::get('/classrooms/{classroom}', 'ClassroomsController@show');                                   // Mostra un’classroom specifica in base all'id

Route::put('/classrooms/{classroom}', 'ClassroomsController@update');                                //Salva le modifiche ad un’classroom

Route::get('/classrooms/{classroom}/delete', 'ClassroomsController@destroy');                         //Cancella l’classroom

Route::get('/classroom/{classroom}', 'ClassroomsController@showName');                              //Restitusce un'classroom in base al nome

Route::patch('/classrooms/{classroom}', 'ClassroomsController@state');                               // apre/chiude classroom

Route::get('/classrooms/{classroom}/presences', 'ClassroomsController@presences');


/**
 * Rotte per le maps
 */

Route::get('/maps', 'MapsController@index');                                       //Restituisce una lista di tutte le maps

Route::post('/maps', 'MapsController@store');                                      //Salva la nuova map aggiunta

Route::post('/maps/{building}/{plane}', 'MapsController@update');                   //Registra le modifiche alla map

Route::get('/maps/{map}/delete', 'MapsController@destroy');                       //Cancella la map

Route::get('/maps/{map}', 'MapsController@show');
//Mostra la map

Route::get('/maps/{building}/{plane}', 'MapsController@show_map_building');


/**
 * Rotte per le bookings
 */

Route::get('/bookings', 'BookingsController@index');                         //Mostra tutte le bookings

Route::post('/bookings', 'BookingsController@store');         //Registra la nuova booking

Route::get('/bookings/{booking}:', 'BookingsController@show');           //Mostra una booking

Route::patch('/bookings/{booking}', 'BookingsController@update');        //Registra le modifiche alla booking

Route::get('/bookings/{booking}/delete', 'BookingsController@destroy');   //Elimina una booking

Route::patch('/bookings/{booking}', 'BookingsController@state');         // accetta/rifiuta booking


/**
 * Rotte per i places
 */

Route::get('/places/classroom/{id_classroom}', 'PlacesController@index_classroom');                                 //Mostra tutti i places all'interno di un'classroom

Route::get('/places', 'PlacesController@index');

Route::post('/places', 'PlacesController@store');                                          //crea il nuovo place

Route::get('/places/{id_place}', 'PlacesController@show');                                 //Mostra un place

Route::patch('/places/{id_place}', 'PlacesController@stato');

Route::put('/places/{id_place}', 'PlacesController@update');                               //Registra le modifiche al place

Route::get('/places/{id_place}/delete', 'PlacesController@destroy');                        //Elimina una booking


/**
 * Rotte per le presences
 */
Route::get('/presences', 'PresencesController@index');

Route::post('/presences', 'PresencesController@store');

Route::get('/presences/{presence}', 'PresencesController@show');

Route::put('/presences/{presence}', 'PresencesController@update');

Route::get('/presences/{presence}/delete', 'PresencesController@destroy');

Route::patch('/presences/{presence}', 'PresencesController@exit');


/**
 * Rotte per le occupations
 */
Route::get('/occupations', 'OccupationController@index');

Route::post('/occupations', 'OccupationController@store');

Route::get('/occupations/{occupation}', 'OccupationController@show');

Route::put('/occupations/{occupation}', 'OccupationController@update');

Route::get('/occupations/{occupation}/delete', 'OccupationController@destroy');


