<?php class suivis{
        		 public $id;
        		 public $idutulisateur;
        		 public $idauteur;
        		public function __construct($tab){
    			$this->id=$tab[0];
    			$this->idutulisateur=$tab[1];
    			$this->idauteur=$tab[2];
    			}
    	}	?>