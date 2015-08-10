<?php

class ReseptiController extends BaseController {

    public static function index() {
        // Haetaan kaikki reseptit tietokannasta
        $reseptit = Resepti::all();
        // Renderöidään views/resepti kansiossa sijaitseva tiedosto index.html muuttujan $reseptit datalla
        View::make('resepti/index.html', array('reseptit' => $reseptit));
    }

    public static function show($id) {
    // Haetaan kyseinen resepti tietokannasta
              $resepti = Resepti::find($id);
        View::make('resepti/show.html', array('resepti' => $resepti));
    }

    public static function store() {
        // POST-pyynnön muuttujat sijaitsevat $_POST nimisessä assosiaatiolistassa
        $params = $_POST;
        // Alustetaan uusi Resepti-luokan olion käyttäjän syöttämillä arvoilla
        $resepti = new Resepti(array(
            'reseptin_nimi' => $params['reseptin_nimi'],
            'annokset' => $params['annokset'],
            'valmisteluaika' => $params['valmisteluaika'],
            'kypsymisaika' => $params['kypsymisaika'],
            'uunin_asteet' => $params['uunin_asteet'],
            'valmistusohje' => $params['valmistusohje'],
            'laatija' => $params['laatija']
        ));

        // Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
        $resepti->save();

        // Ohjataan käyttäjä lisäyksen jälkeen reseptin sivulle
        Redirect::to('/resepti' . $resepti->id, array('message' => 'Resepti on lisätty'));
    }

    public static function create() {
        View::make('resepti/new.html');
    }

}
