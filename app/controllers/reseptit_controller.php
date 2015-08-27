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
//        $raaka_aineet = $params['raaka_aineet'];
// Alustetaan uusi Resepti-luokan olion käyttäjän syöttämillä arvoilla
        $attributes = array(
            'reseptin_nimi' => $params['reseptin_nimi'],
            'annokset' => $params['annokset'],
            'valmisteluaika' => $params['valmisteluaika'],
            'kypsymisaika' => $params['kypsymisaika'],
            'uunin_asteet' => $params['uunin_asteet'],
//            'raaka_aineet' => array(),
            'valmistusohje' => $params['valmistusohje'],
            'laatija' => $params['laatija']
        );

//        foreach ($raaka_aineet as $raaka_aine) {
//            $attributes['raaka_aineet'][] = $raaka_aine;
//        }



        $resepti = new Resepti($attributes);
        $errors = $resepti->errors();
        if (count($errors) == 0) {
            // Resepti on validi, hyvä homma!
// Kutsutaan alustamamme olion save metodia, joka tallentaa olion tietokantaan
            $resepti->save();
// Ohjataan käyttäjä lisäyksen jälkeen reseptin sivulle
            Redirect::to('/resepti', array('message' => 'Resepti on lisätty'));
        } else {
            View::make('resepti/new.html', array('errors' => $errors, 'attributes' => $resepti));
        }
    }

//    }
    public static function create() {
        $raaka_aineet = Raaka_aine::all();
        View::make('resepti/new.html', array('raaka_aineet' => $raaka_aineet));
    }

    // Reseptin muokkaaminen (lomakkeen esittäminen)
    public static function edit($id) {
        $resepti = Resepti::find($id);
        View::make('resepti/edit.html', array('attributes' => $resepti));
    }

// Reseptin muokkaaminen (lomakkeen käsittely)
    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'reseptin_nimi' => $params['reseptin_nimi'],
            'annokset' => $params['annokset'],
            'valmisteluaika' => $params['valmisteluaika'],
            'kypsymisaika' => $params['kypsymisaika'],
            'uunin_asteet' => $params['uunin_asteet'],
//            'raaka_aineet' => $params['raaka_aineet'],
            'valmistusohje' => $params['valmistusohje'],
            'laatija' => $params['laatija']
        );
// Alustetaan Resepti-olio käyttäjän syöttämillä tiedoilla
        $resepti = new Resepti($attributes);
        $errors = $resepti->errors();
        if (count($errors) == 0) {
            $resepti->update();
            Redirect::to('/resepti', array('message' => 'Reseptiä on muokattu onnistuneesti!'));
        } else {
            View::make('resepti/edit.html', array('errors' => $errors, 'attributes' => $attributes));
        }
    }

// Reseptin poistaminen
    public static function destroy($id) {
// Alustetaan Resepti-olio annetulla id:llä
        $resepti = new Resepti(array('id' => $id));
// Kutsutaan Resepti-malliluokan metodia destroy, joka poistaa reseptin sen id:llä
        $resepti->destroy();
// Ohjataan käyttäjä reseptien listaussivulle ilmoituksen kera
        Redirect::to('/resepti', array('message' => 'Resepti on poistettu onnistuneesti!'));
    }

}
