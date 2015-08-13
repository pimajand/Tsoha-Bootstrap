<?php

class Kayttaja extends BaseModel {

// Attribuutit
    public $id, $kayttaja, $salasana;

    public function __construct($attributes) {
        parent::__construct($attributes);
//        $this->validators = array('kayttaja', 'password');
    }

    public static function authenticate($kayttaja, $salasana) {
        $query = DB::connection()->prepare('SELECT * FROM kayttaja WHERE kayttaja = :kayttaja AND salasana = :salasana LIMIT 1');
        $query->execute(array('kayttaja' => $kayttaja, 'salasana' => $salasana));
        $row = $query->fetch();
        if ($row) {
            $kayttaja = new Kayttaja(array(
                'kayttaja' => $row['kayttaja'],
                'salasana' => $row['salasana']));
            return $kayttaja;
        } else {
            // Käyttäjää ei löytynyt, palautetaan null
            return null;
        }
    }

    public static function find($id, $kayttaja) {
        $query = DB::connection()->prepare('SELECT * FROM Kayttaja WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id, 'kayttaja' => $kayttaja));
        $row = $query->fetch();

        if ($row) {
            $kayttaja = new Kayttaja(array(
                'id' => $row['id'],
                'kayttaja' => $row['kayttaja']));
            return $kayttaja;
        }
        return null;
    }

}
