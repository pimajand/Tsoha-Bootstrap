<?php

class Resepti extends BaseModel {

    public $id, $reseptin_nimi, $annokset, $valmisteluaika, $kypsymisaika, $uunin_asteet, $valmistusohje, $laatija;

    public function __construct($attributes) {
        parent::__construct($attributes);
        $this->validators = array('reseptin_nimi', 'uunin_asteet', 'laatija');
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
        $query = DB::connection()->prepare('INSERT INTO Resepti (reseptin_nimi, annokset, valmisteluaika, kypsymisaika, uunin_asteet, valmistusohje, laatija) VALUES (:reseptin_nimi, :annokset, :valmisteluaika, :kypsymisaika, :uunin_asteet, :valmistusohje, :laatija) RETURNING id');
        $query->execute(array('reseptin_nimi' => $this->reseptin_nimi, 'annokset' => $this->annokset, 'valmisteluaika' => $this->valmisteluaika, 'kypsymisaika' => $this->kypsymisaika, 'uunin_asteet' => $this->uunin_asteet, 'valmistusohje' => $this->valmistusohje, 'laatija' => $this->laatija));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];

        $query = DB::connection()->prepare('INSERT INTO Reseptin_aine (resepti_id, raaka_aine_id) VALUES(:Resepti.id, :Raaka_aine.id) RETURNING raaka_aine');
        $query->execute(array('resepti_id' => $this->resepti_id, 'raaka_aine_id' => $this->raaka_aine_id));
        $row = $query->fetch();
        $this->raaka_aine = $row['raaka_aine'];
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

    public function uunin_asteet() {
        $errors = array();
        if ((strlen($this->uunin_asteet) < 2) || (strlen($this->uunin_asteet) > 3)) {
            $errors[] = 'Uunin lämpötilan tulee olla 2-3 merkkiä pitkä!';
        }
        if (!is_numeric($this->uunin_asteet)) {
            $errors[] = 'Uunin lämpötilan tulee olla numeerinen!';
        }
        return $errors;
    }

    public function laatija() {
        $errors = array();
        if ($this->laatija == '' || $this->laatija == null) {
            $errors[] = 'Käyttäjätunnus ei saa olla tyhjä!';
        }
        if (strlen($this->laatija) != 6) {
            $errors[] = 'Reseptin laatijan käyttäjätunnus on 6 merkkiä!';
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
