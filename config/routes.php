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
