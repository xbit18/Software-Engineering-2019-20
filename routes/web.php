<?php
Route::options('/{path}', function(){
    return '';
})->where('path', '.*');



Route::post('/login', 'LoginController@check');



/**
 * Rotte per gli edifici
 */

Route::get('/edifici','EdificiController@index');                                   //Index mostra una lista di tutti gli edifici

Route::post('/edifici','EdificiController@store');                                  //Store salva le modifiche all’edificio

Route::get('/edifici/{edificio}','EdificiController@show');                         //Show mostra un edificio specifico

Route::put('/edifici/{edificio}','EdificiController@update');                       //Update salva le modifiche

Route::get('/edifici/{edificio}/delete','EdificiController@destroy');               // Delete lo elimina




/**
 * Rotte per le aule
 */

Route::get('/aule','AuleController@index');                                         //Restituisce una lista delle aule che appartengono a un edificio

Route::post('/aule','AuleController@store');                                        //Salva la nuova aula

Route::get('/aule/{aula}','AuleController@show');                                   // Mostra un’aula specifica in base all'id

Route::put('/aule/{aula}','AuleController@update') ;                                //Salva le modifiche ad un’aula

Route::get('/aule/{aula}/delete','AuleController@destroy');                         //Cancella l’aula

Route::get('/aula/{aula}', 'AuleController@showNome');                              //Restitusce un'aula in base al nome

Route::patch('/aule/{aula}','AuleController@stato');                               // apre/chiude aula

Route::get('/aule/{aula}/presenze', 'AuleController@presenze');




/**
 * Rotte per le mappe
 */

Route::get('/mappe','MappeController@index');                                       //Restituisce una lista di tutte le mappe

Route::post('/mappe/{edificio}/{piano}','MappeController@store');                   //Salva la nuova mappa aggiunta

Route::post('/mappe/upload')

Route::get('/mappe/{edificio}/{piano}','MappeController@show');                     //Mostra la mappa del piano

Route::put('/mappe/{edificio}/{piano}','MappeController@update');                   //Registra le modifiche alla mappa

Route::get('/mappe/{mappa}/delete','MappeController@delete');                       //Cancella la mappa




/**
 * Rotte per le prenotazioni
 */

Route::get('/prenotazioni','PrenotazioniController@index');                         //Mostra tutte le prenotazioni

Route::post('/prenotazioni/{prenotazione}','PrenotazioniController@store');         //Registra la nuova prenotazione

Route::get('/prenotazioni/{prenotazione}','PrenotazioniController@show');           //Mostra una prenotazione

Route::patch('/prenotazioni/{prenotazione}','PrenotazioniController@update');        //Registra le modifiche alla prenotazione

Route::get('/prenotazioni/{prenotazione}/delete','PrenotazioniController@delete');   //Elimina una prenotazione

Route::patch('/prenotazioni/{prenotazione}','PrenotazioniController@stato');         // accetta/rifiuta prenotazione




/**
 * Rotte per i posti
 */

Route::get('/posti/aula/{id_aula}','PostiController@index');                                 //Mostra tutti i posti all'interno di un'aula

Route::post('/posti','PostiController@store');                                          //crea il nuovo posto

Route::get('/posti/{id_posto}','PostiController@show');                                 //Mostra un posto

Route::patch('/posti/{id_posto}','PostiController@update');                               //Registra le modifiche al posto

Route::get('/posti/{id_posto}/delete','PostiController@destroy');                        //Elimina una prenotazione




Route::post('/checks', 'CheckController@store');                                    //Effettua check-in e check-out

?>
