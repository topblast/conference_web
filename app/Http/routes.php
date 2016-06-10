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

$app->post('clients/register', 'ClientsController@register');
$app->post('clients/{id}/changepassword', 'ClientsController@change_password');

//put
$app->delete('/clients/{id}', 'ClientsController@delete_client');
$app->put('/clients/{id}', 'ClientsController@edit_client');



//conferences
$app->get('/conferences/', 'ConferencesController@get_all');
$app->get('/conferences/{id}', 'ConferencesController@get_id');

$app->get('/conferences/{id}/presentations/', 'ConferencesController@get_presentations');
$app->get('/conferences/{id}/sponsors/', 'ConferencesController@get_sponsors');


$app->post('conferences/register', 'ConferencesController@register');
$app->post('conferences/{id}/presentations', 'ConferencesController@create_new_presentation');
$app->post('conferences/{id}/sponsors', 'ConferencesController@create_new_sponsor');

    //these didn't work
$app->delete('/conferences/{id}', 'ConferencesController@delete_conference');
$app->delete('/conferences/{id}/sponsors/', 'ConferencesController@delete_sponsor');
    //these

$app->put('/conferences/{id}', 'ConferencesController@edit_conferences');


//speakers
$app->get('/speakers/', 'SpeakersController@get_all');
$app->get('/speakers/{id}/presentations', 'SpeakersController@get_presentations');

$app->post('/speakers/', 'SpeakersController@create_new');







//attendees
$app->post('/attendees/login', 'AttendeesController@login');
$app->post('/attendees/register', 'AttendeesController@register');

$app->get('/attendees', 'AttendeesController@get_all');
$app->get('/attendees/{id}', 'AttendeesController@get_id');

$app->post('attendees/register', 'AttendeesController@register');
$app->post('attendees/{id}/changepassword', 'AttendeesController@change_password');

$app->delete('/attendees/{id}', 'AttendeesController@delete_attendee');

//put
$app->put('/attendees/{id}', 'AttendeesController@edit_attendee');

$app->get('/attendees/{id}/conferences', 'AttendeesController@get_conferences');


//nothing to link presentations to speakers OR attendees to conferences

//IF RETURNS EMPTY ARRAY SHOW MESSAGE SAYING NO ID FOUND



/*
add attendee to conference
$app->post('', '');

add speaker to presentation
$app->post('', '');

*/