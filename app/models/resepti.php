<?php

class Resepti extends BaseModel {

// Attribuutit
    public $id, $reseptin_nimi, $annokset, $valmisteluaika, $kypsymisaika, $uunin_asteet, $kuva, $valmistusohje, $laatija;

// Konstruktori
    public function __construct($attributes) {
        parent::__construct($attributes);
    }

    public static function all() {
// Alustetaan kysely tietokantayhteydellämme
        $query = DB::connection()->prepare('SELECT * FROM Resepti');
// Suoritetaan kysely
        $query->execute();
// Haetaan kyselyn tuottamat rivit
        $rows = $query->fetchAll();
        $reseptit = array();

// Käydään kyselyn tuottamat rivit läpi
        foreach ($rows as $row) {
// Tämä on PHP:n hassu syntaksi alkion lisäämiseksi taulukkoon :)
            $reseptit[] = new Resepti(array(
                'id' => $row['id'],
                'reseptin_nimi' => $row['reseptin_nimi'],
                'annokset' => $row['annokset'],
                'valmisteluaika' => $row['valmisteluaika'],
                'kypsymisaika' => $row['kypsymisaika'],
                'uunin_asteet' => $row['uunin_asteet'],
                'valmistusohje' => $row['valmistusohje'],
                'laatija' => $row['laatija']
            ));
        }

        return $reseptit;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Resepti WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();

        if ($row) {
            $resepti = new Resepti(array(
                'id' => $row['id'],
                'reseptin_nimi' => $row['reseptin_nimi'],
                'annokset' => $row['annokset'],
                'valmisteluaika' => $row['valmisteluaika'],
                'kypsymisaika' => $row['kypsymisaika'],
                'uunin_asteet' => $row['uunin_asteet'],
                'valmistusohje' => $row['valmistusohje'],
                'laatija' => $row['laatija']
            ));

            return $resepti;
        }

        return null;
    }

    public function save() {
        // Lisätään RETURNING id tietokantakyselymme loppuun, niin saamme lisätyn rivin id-sarakkeen arvon
        $query = DB::connection()->prepare('INSERT INTO Resepti (reseptin_nimi, annokset, valmisteluaika, kypsymisaika, uunin_asteet, valmistusohje, laatija) VALUES (:reseptin_nimi, :annokset, :valmisteluaika, :kypsymisaika, :uunin_asteet, :valmistusohje, :laatija) RETURNING id');
        // Muistathan, että olion attribuuttiin pääse syntaksilla $this->attribuutin_nimi
        $query->execute(array('reseptin_nimi' => $this->reseptin_nimi, 'annokset' => $this->annokset, 'valmisteluaika' => $this->valmisteluaika, 'kypsymisaika' => $this->kypsymisaika, 'uunin_asteet' => $this->uunin_asteet, 'valmistusohje' => $this->valmistusohje, 'laatija' => $this->laatija));
        // Haetaan kyselyn tuottama rivi, joka sisältää lisätyn rivin id-sarakkeen arvon
        $row = $query->fetch();
        Kint::trace();
        Kint::dump($row);
        // Asetetaan lisätyn rivin id-sarakkeen arvo oliomme id-attribuutin arvoksi
        //$this->id = $row['id'];
    }

}
