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




Route::options('/{path}', function(){
    return '';
})->where('path', '.*');

Route::get('/me', 'Auth\AuthController@me');
Route::post('/login', 'Auth\AuthController@login')->name('login');;
Route::post('/logout', 'Auth\AuthController@logout');
Route::post('/register', 'Auth\AuthController@register');




/**
 * Rotte per gli edifici
 */
Route::get('/buildings/{building}/delete','BuildingsController@destroy');               // Delete lo elimina

Route::get('/buildings','BuildingsController@index');                                   //Index mostra una lista di tutti gli buildings

Route::post('/buildings','BuildingsController@store');                                  //Store salva le modifiche all’buildingso

Route::get('/buildings/{building}','BuildingsController@show');                         //Show mostra un buildingso specifico

Route::put('/buildings/{building}','BuildingsController@update');                       //Update salva le modifiche

Route::get('/buildings/classrooms/{building}','BuildingsController@classrooms');





/**
 * Rotte per le aule
 */

Route::get('/classrooms','ClassroomsController@index');                                         //Restituisce una lista delle classrooms che appartengono a un edificio

Route::post('/classrooms','ClassroomsController@store');                                        //Salva la nuova aula

Route::get('/classrooms/{clasroom}','ClassroomsController@show');                                   // Mostra un’aula specifica in base all'id

Route::put('/classrooms/{clasroom}','ClassroomsController@update') ;                                //Salva le modifiche ad un’aula

Route::get('/classrooms/{clasroom}/delete','ClassroomsController@destroy');                         //Cancella l’aula

Route::get('/classroom/{clasroom}', 'ClassroomsController@showWithName');                              //Restitusce un'clasroom in base al nome

Route::patch('/classrooms/{clasroom}','ClassroomsController@state');                               // apre/chiude clasroom

Route::get('/classrooms/{classroom}/attendances', 'ClassroomsController@attendances');







/**
 * Rotte per le mappe
 */

Route::get('/maps','MapsController@index');                                       //Restituisce una lista di tutte le maps

Route::post('/maps','MapsController@store');                                      //Salva la nuova map aggiunta

Route::post('/maps/{map}/update','MapsController@update');                   //Registra le modifiche alla map

Route::get('/maps/{map}/delete','MapsController@destroy');                       //Cancella la map

Route::get('/maps/{map}','MapsController@show');
//Mostra la map

Route::get('/maps/{building}/{floor}','MapsController@showWithFloorAndBuilding');





/**
 * Rotte per le prenotazioni
 */

Route::get('/classroomreservations','ClassroomReservationsController@index');                         //Mostra tutte le classroomreservations

Route::post('/classroomreservations','ClassroomReservationsController@store');         //Registra la nuova prenotazione

Route::get('/classroomreservations/{classroomreservation}','ClassroomReservationsController@show');           //Mostra una classroomreservation

Route::put('/classroomreservations/{classroomreservation}','ClassroomReservationsController@update');        //Registra le modifiche alla classroomreservation

Route::get('/classroomreservations/{classroomreservation}/delete','ClassroomReservationsController@destroy');   //Elimina una classroomreservation

Route::patch('/classroomreservations/{classroomreservation}','ClassroomReservationsController@state');         // accetta/rifiuta classroomreservation



/**
 * Rotte per i posti
 */

Route::get('/seats/classroom/{classroom_id}','SeatsController@index_aula');                                 //Mostra tutti i seats all'interno di un'classroom

Route::get('/seats','SeatsController@index');

Route::post('/seats','SeatsController@store');                                          //crea il nuovo posto

Route::get('/seats/{seat_id}','SeatsController@show');                                 //Mostra un posto

Route::patch('/seats/{seat_id}','SeatsController@state');

Route::put('/seats/{seat_id}','SeatsController@update');                               //Registra le modifiche al posto

Route::get('/seats/{seat_id}/delete','SeatsController@destroy');                        //Elimina una prenotazione


/**
 * Rotte per le presenze
 */

Route::get('/attendances','AttendancesController@index');

Route::post('/checkin','AttendancesController@store');

Route::get('/attendances/{attendance}','AttendancesController@show');

Route::put('/attendances/{attendance}','AttendancesController@update');

Route::get('/attendances/{attendance}/delete','AttendancesController@destroy');

Route::patch('/checkout', 'AttendancesController@checkOut');


/**
 * Rotte per le occupazioni
 */

Route::get('/seatreservations','SeatReservationsController@index');

Route::post('/seatreservations','SeatReservationsController@store');

Route::get('/seatreservations/{seatreservation}','SeatReservationsController@show');

Route::put('/seatreservations/{seatreservation}','SeatReservationsController@update');

Route::get('/seatreservations/{seatreservation}/delete','SeatReservationsController@destroy');


Route::get('/tokens','TokensController@index');

Route::post('/tokens','TokensController@store');

Route::get('/tokens/{id}','TokensController@show');

Route::put('/tokens/{id}','TokensController@update');

Route::get('/tokens/{id}/delete','TokensController@destroy');

Route::get('/tokens/classroom/{id}','TokensController@updateToken');

