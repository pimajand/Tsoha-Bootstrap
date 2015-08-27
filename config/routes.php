<?php

function check_logged_in() {
    BaseController::check_logged_in();
}

// Reseptin lisääminen tietokantaan
$routes->post('/resepti', 'check_logged_in', function() {
    ReseptiController::store();
});
// Reseptin lisäyslomakkeen näyttäminen
$routes->get('/resepti/new', 'check_logged_in', function() {
    ReseptiController::create();
});

// Reseptien listaussivu
$routes->get('/resepti', function() {
    ReseptiController::index();
});

// Reseptin esittelysivu
$routes->get('/resepti/:id', function($id) {
    ReseptiController::show($id);
});

$routes->get('/resepti/:id/edit', 'check_logged_in', function($id) {
    // Reseptin muokkauslomakkeen esittäminen
    ReseptiController::edit($id);
});
$routes->post('/resepti/:id/edit', 'check_logged_in', function($id) {
    // Reseptin muokkaaminen
    ReseptiController::update($id);
});

$routes->post('/resepti/:id/destroy', 'check_logged_in', function($id) {
    // Reseptin poisto
    ReseptiController::destroy($id);
});

$routes->get('/user/login', function() {
    // Kirjautumislomakkeen esittäminen
    UserController::login();
});
$routes->post('/user/login', function() {
    // Kirjautumisen käsittely
    UserController::handle_login();
});

$routes->post('/user/logout', function(){
  UserController::logout();
});

$routes->get('/raaka_aine', function(){
  Raaka_aineController::index();
});
$routes->get('/raaka_aine/new', 'check_logged_in', function(){
  Raaka_aineController::create();
});

$routes->get('/raaka_aine/:id', function($id){
  Raaka_aineController::show($id);
});

$routes->post('/raaka_aine', 'check_logged_in', function(){
  Raaka_aineController::store();
});

$routes->get('/raaka_aine/:id/edit', 'check_logged_in', function($id){
  Raaka_aineController::edit($id);
});

$routes->post('/raaka_aine/:id/edit', 'check_logged_in', function($id){
  Raaka_aineController::update($id);
});

$routes->post('/raaka_aine/:id/destroy', 'check_logged_in', function($id){
  Raaka_aineController::destroy($id);
});