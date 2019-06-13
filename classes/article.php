<?php class article{
        		 public $id;
        		 public $titre;
        		 public $description;
        		 public $image;
        		 public $vus;
        		 public $date_creation;
        		 public $date_modification;
        		 public $categorie;
        		 public $auteur;
        		public function __construct($tab){
    			$this->id=$tab[0];
    			$this->titre=$tab[1];
    			$this->description=$tab[2];
    			$this->image=$tab[3];
    			$this->vus=$tab[4];
    			$this->date_creation=$tab[5];
    			$this->date_modification=$tab[6];
    			$this->categorie=$tab[7];
    			$this->auteur=$tab[8];
    			}
    	}	?>