<?php class commentaire{
        		 public $id;
        		 public $commentaire;
        		 public $user;
        		 public $article;
        		 public $dateCom;
        		public function __construct($tab){
    			$this->id=$tab[0];
    			$this->commentaire=$tab[1];
    			$this->user=$tab[2];
    			$this->article=$tab[3];
    			$this->dateCom=$tab[4];
    			}
    	}	?>