<?php

class Raaka_aine extends BaseModel {

    public $id, $raaka_aine;

    public function _construct($raaka_aine) {
        parent::__construct($attributes);
        $this->validators = array('raaka_aine');
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Raaka_aine');
        $query->execute();
        $rows = $query->fetchAll();
        $raaka_aineet = array();
        foreach ($rows as $row) {
            $raaka_aineet[] = new Raaka_aine(array(
                'id' => $row['id'],
                'raaka_aine' => $row['raaka_aine']
            ));
        }
        return $raaka_aineet;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Raaka_aine WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $raaka_aine = new Raaka_aine(array(
                'id' => $row['id'],
                'raaka_aine' => $row['raaka_aine']
            ));
            return $raaka_aine;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Raaka_aine (raaka_aine) VALUES (:raaka_aine) RETURNING id');
        $query->execute(array('raaka_aine' => $this->raaka_aine));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function raaka_aineen_nimi() {
        $errors = array();
        if ($this->raaka_aine == '' || $this->raaka_aine == null) {
            $errors[] = 'Raaka-aineen nimi ei saa olla tyhjä!';
        }
        if (strlen($this->raaka_aine) < 3) {
            $errors[] = 'Raaka-aineen nimen pituuden tulee olla vähintään kolme merkkiä!';
        }
        return $errors;
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Raaka_aine SET raaka_aine = :raaka_aine WHERE id = :id');
        $query->execute(array('id' => $this->id, 'raaka_aine' => $this->raaka_aine));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Raaka_aine WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

}
