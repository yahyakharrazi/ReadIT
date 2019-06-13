<?php class utilisateur{
        		 public $id;
        		 public $nom;
        		 public $prenom;
        		 public $email;
        		 public $motdepasse;
        		 public $fonction;
        		 public $ville;
        		 public $sexe;
        		public function __construct($tab){
    			$this->id=$tab[0];
    			$this->nom=$tab[1];
    			$this->prenom=$tab[2];
    			$this->email=$tab[3];
    			$this->motdepasse=$tab[4];
    			$this->fonction=$tab[5];
    			$this->ville=$tab[6];
    			$this->sexe=$tab[7];
    			}
    	}	?>