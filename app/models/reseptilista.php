<?php

  //Otetaan käyttöön kirjastotiedosto, joka hakee kasan omatekoisia yleistoimintoja, sekä malliluokka:
  require_once 'src/common.php';
  require_once 'src/models/resepti.php';
  
  //Selvitetään onko käyttäjä tehnyt haun
  $hakusana = null;
  if (!empty($_GET['haku'])) {
    $hakusana = $_GET['haku'];
  }

  //Kutsutaan malliluokan staattista metodia
  $reseptit = Resepti::etsiHakusanalla($hakusana);
  
  //Näytetään näkymä lähettäen sille muutamia muuttujia
  naytaNakymä("reseptilista", array(
    'title' => "Reseptit aakkosjärjestyksessä",
    'reseptit' => $reseptit
  ));

