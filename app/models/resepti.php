<?php

class Resepti extends BaseModel {

    public $id, $reseptin_nimi, $annokset, $valmisteluaika, $kypsymisaika, $uunin_asteet, $valmistusohje, $laatija;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('reseptin_nimi');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Resepti');
        $query->execute();
        $rows = $query->fetchAll();
        $reseptit = array();
        foreach ($rows as $row) {
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
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    public function reseptin_nimi() {
        $errors = array();
        if ($this->reseptin_nimi == '' || $this->reseptin_nimi == null) {
            $errors[] = 'Nimi ei saa olla tyhjä!';
        }
        if (strlen($this->reseptin_nimi) < 3) {
            $errors[] = 'Nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        return $errors;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Resepti SET reseptin_nimi = :reseptin_nimi, annokset = :annokset, valmisteluaika = :valmisteluaika, kypsymisaika = :kypsymisaika, uunin_asteet = :uunin_asteet, valmistusohje = :valmistusohje, laatija = :laatija
WHERE id = :id');
        $query->execute(array('id' => $this->id, 'reseptin_nimi' => $this->reseptin_nimi, 'annokset' => $this->annokset, 'valmisteluaika' => $this->valmisteluaika, 'kypsymisaika' => $this->kypsymisaika, 'uunin_asteet' => $this->uunin_asteet, 'valmistusohje' => $this->valmistusohje, 'laatija' => $this->laatija));
//        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
//        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Resepti WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

}
