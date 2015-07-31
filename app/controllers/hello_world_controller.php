<?php

class HelloWorldController extends BaseController {

    public static function index() {
        // make-metodi renderöi app/views-kansiossa sijaitsevia tiedostoja
        echo 'Tämä on etusivu!';
    }

    public static function sandbox() {
        // Testaa koodiasi täällä
        View::make('helloworld.html');
    }

    public static function reseptilista() {
        View::make('suunnitelmat/reseptilista.html');
    }

    public static function kirjautuminen() {
        View::make('suunnitelmat/kirjautumissivu.html');
    }

    public static function resepti() {
        View::make('suunnitelmat/resepti.html');
    }

    public static function muokkaus() {
        View::make('suunnitelmat/muokkaussivu.html');
    }

}
