<?php

class UserController extends BaseController {

    public static function login() {
        View::make('user/login.html');
    }

    public static function handle_login() {
        $params = $_POST;

        $kayttaja = Kayttaja::authenticate($params['kayttaja'], $params['salasana']);

        if (!$kayttaja) {
            View::make('user/login.html', array('error' => 'Väärä käyttäjätunnus tai salasana!', 'kayttaja' => $params['kayttaja']));
        } else {
            $_SESSION['kayttaja'] = $kayttaja->id;
//Kint::dump($kayttaja);

            Redirect::to('/resepti', array('message' => 'Tervetuloa takaisin ' . $kayttaja->kayttaja . '!'));
        }
    }
    
    public static function logout(){
    $_SESSION['kayttaja'] = null;
    Redirect::to('/user/login', array('message' => 'Olet kirjautunut ulos!'));
  }

}
