<?php

// Reseptin lisääminen tietokantaan
$routes->post('/resepti', function(){
  ReseptiController::store();
});
// Reseptin lisäyslomakkeen näyttäminen
$routes->get('/resepti/new', function(){
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

$routes->get('/resepti/:id/edit', function($id){
  // Reseptin muokkauslomakkeen esittäminen
  ReseptiController::edit($id);
});
$routes->post('/resepti/:id/edit', function($id){
  // Reseptin muokkaaminen
  ReseptiController::update($id);
});

$routes->post('/resepti/:id/destroy', function($id){
  // Reseptin poisto
  ReseptiController::destroy($id);
});

$routes->get('/user/login', function(){
  // Kirjautumislomakkeen esittäminen
  UserController::login();
});
$routes->post('/user/login', function(){
  // Kirjautumisen käsittely
  UserController::handle_login();
});