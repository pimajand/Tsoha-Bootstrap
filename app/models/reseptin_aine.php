<?php

class Reseptin_aine extends BaseModel {

    public $raaka_aine_id, $resepti_id, $maara;

    public function _construct($maara) {
        parent::__construct($attributes);
    }

    public static function all() {
        $query = DB::connection()->prepare('SELECT * FROM Reseptin_aine');
        $query->execute();
        $rows = $query->fetchAll();
        $maarat = array();
        foreach ($rows as $row) {
            $maarat[] = new Reseptin_aine(array(
                'raaka_aine_id' => $row['raaka_aine_id'],
                'resepti_id' => $row['resepti.id'],
                'maara' => $row['maara']
            ));
        }
        return $maarat;
    }

    public static function find($id) {
        $query = DB::connection()->prepare('SELECT * FROM Reseptin_aine WHERE id = :id LIMIT 1');
        $query->execute(array('id' => $id));
        $row = $query->fetch();
        if ($row) {
            $raaka_aine = new Reseptin_aine(array(
                'raaka_aine_id' => $row['raaka_aine_id'],
                'resepti_id' => $row['resepti_id'],
                'maara' => $row['maara']
            ));
            return $maara;
        }
        return null;
    }

    public function save() {
        $query = DB::connection()->prepare('INSERT INTO Reseptin_aine (maara) VALUES (:maara) RETURNING id');
        $query->execute(array('maara' => $this->maara));
        $row = $query->fetch();
        $this->id = $row['id'];
    }

    public function update() {
        $query = DB::connection()->prepare('UPDATE Reseptin_aine SET maara = :maara WHERE id = :id');
        $query->execute(array('id' => $this->id, 'maara' => $this->maara));
        $row = $query->fetch();
//        Kint::trace();
//        Kint::dump($row);
        $this->id = $row['id'];
    }

    public function destroy() {
        $query = DB::connection()->prepare('DELETE FROM Reseptin_aine WHERE id = :id');
        $query->execute(array('id' => $this->id));
    }

}
