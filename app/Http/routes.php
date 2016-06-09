<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It is a breeze. Simply tell Lumen the URIs it should respond to
| and give it the Closure to call when that URI is requested.
|
*/

$app->get('/', function () use ($app) {
    return $app->version();
});


//client
$app->post('/clients/login', 'ClientsController@login');
$app->post('/clients/register', 'ClientsController@register');
$app->get('/clients', 'ClientsController@get_all');
$app->get('/clients/{id}', 'ClientsController@get_id');
//put
$app->delete('/clients/{id}', 'ClientsController@delete_client');
$app->put('/clients/{id}', 'ClientsController@edit_client');



//conferences
$app->get('/conferences/', 'ConferencesController@get_all');
$app->get('/conferences/{id}', 'ConferencesController@get_id');

$app->delete('/conferences/{id}', 'ConferencesController@delete_conference');
$app->put('/conferences/{id}', 'ConferencesController@edit_conferences');


//speakers
$app->get('/speakers/', 'SpeakersController@get_all');
$app->post('/speakers/', 'SpeakersController@create');



//Speaker Presentations
$app->get('/speakers/{id}/presentations', 'SpeakersController@get_presentations');



//attendees
$app->get('/attendees', 'AttendeesController@get_all');
$app->get('/attendees/{id}', 'AttendeesController@get_id');


$app->delete('/attendees/{id}', 'AttendeesController@delete_attendee');

//put
$app->put('/attendees/{id}', 'AttendeesController@edit_attendee');