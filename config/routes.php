<?php

$routes->get('/', function() {
    HelloWorldController::index();
});

$routes->get('/hiekkalaatikko', function() {
    HelloWorldController::sandbox();
});

$routes->get('/reseptilista', function() {
    HelloWorldController::reseptilista();
});

$routes->get('/kirjautumissivu', function() {
    HelloWorldController::kirjautuminen();
});

$routes->get('/resepti', function() {
    HelloWorldController::resepti();
});

$routes->get('/muokkaussivu', function() {
    HelloWorldController::muokkaus();
});
