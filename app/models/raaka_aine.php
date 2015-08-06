<?php

  class Raaka_aine extends BaseModel{
      
      public $raaka_aine_id, $raaka_aineen_nimi;
      
      public function _construct($raaka_aineen_nimi){
         $this->raaka_aineen_id = 
         $this->raaka_aineen_nimi = $raaka_aineen_nimi;  
      }

        
  }

  
   