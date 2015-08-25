<?php

class Raaka_aineController extends BaseController {

    public static function index() {
        $raaka_aineet = Raaka_aine::all();
        View::make('raaka_aine/index.html', array('raaka_aineet' => $raaka_aineet));
    }

    public static function show($id) {
        $raaka_aine = Raaka_aine::find($id);
        View::make('raaka_aine/show.html', array('raaka_aine' => $raaka_aine));
    }

    public static function store() {
        $params = $_POST;
        $raaka_aine = new Raaka_aine(array(
            'raaka_aine' => $params['raaka_aine']
        ));
        $errors = $raaka_aine->errors();
        if (count($errors) == 0) {
            $raaka_aine->save();
            Redirect::to('/raaka_aine', array('message' => 'Raaka-aine on lisätty'));
        } else {
            View::make('raaka_aine/new.html', array('errors' => $errors, 'attributes' => $raaka_aine));
        }
    }

    public static function create() {
        View::make('raaka_aine/new.html');
    }

    public static function edit($id) {
        $raaka_aine = Raaka_aine::find($id);
        View::make('raaka_aine/edit.html', array('attributes' => $raaka_aine));
    }

    public static function update($id) {
        $params = $_POST;
        $attributes = array(
            'id' => $id,
            'raaka_aine' => $params['raaka_aine']
        );
        $raaka_aine = new Raaka_aine($attributes);
        $errors = $raaka_aine->errors();
        if (count($errors) > 0) {
            View::make('raaka_aine/edit.html', array('errors' => $errors, 'attributes' => $raaka_aine));
        } else {
            $raaka_aine->update();
            Redirect::to('/raaka_aine', array('message' => 'Raaka-ainetta on muokattu onnistuneesti!'));
        }
    }

    public static function destroy($id) {
        $raaka_aine = new Raaka_aine(array('id' => $id));
        $raaka_aine->destroy();
        Redirect::to('/raaka_aine', array('message' => 'Raaka-aine on poistettu onnistuneesti!'));
    }

}
