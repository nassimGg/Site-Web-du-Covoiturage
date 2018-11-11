<?php 
//class voiture
class Voiture
{ private $_num_imm,$_marque,$_annee,$_nb_place,$_couleur,$_kilometrage,
$_id_conducteur,$_photo;

//constructeur
 public function __construct(array $donnees)

  {
    $this->hydrate($donnees);
  }
 //getteur
public function num_imm()
{ return $this->_num_imm;
}
public function marque()
{ return $this->_marque;
}
public function annee()
{ return $this->_annee;
}
public function nb_place()
{ return $this->_nb_place;
}	
public function couleur()
{ return $this->_couleur;
}	
public function kilometrage()
{ return $this->_kilometrage;
}	
public function id_conducteur()
{ return $this->_id_conducteur;
}
public function photo()
{ return $this->_photo;
}	

//setteur
public function setNum_imm($num_imm)
{ $this->_num_imm=$num_imm;
}
public function setMarque($marque)
{ $this->_marque=$marque;
}
public function setAnnee($annee)
{ $this->_annee=$annee;
}
public function setNb_place($nb_place)
{ $this->_nb_place=$nb_place;
}
public function setCouleur($couleur)
{ $this->_couleur=$couleur;
}
public function setKilometrage($kilometrage)
{ $this->_kilometrage=$kilometrage;
}
public function setId_conducteur($id_conducteur)
{ $this->_id_conducteur=$id_conducteur;
}
public function setPhoto($photo)
{ $this->_photo=$photo;
}

//fonction hydrate permet d'assigner des valeurs à des attributs d'un objet

 public function hydrate(array $donnees)
  {
    foreach ($donnees as $key => $value)
    {
      $method = 'set'.ucfirst($key);
      if (method_exists($this, $method))
      {
        $this->$method($value);
      }
    }
  }

}
?>