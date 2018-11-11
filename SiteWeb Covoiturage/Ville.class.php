<?php 
//class ville
class Ville
{ private $_num_ville,$_nom_ville;

//constructeur
 public function __construct(array $donnees)

  {
    $this->hydrate($donnees);
  }


//getteur 
public function num_ville()
{ return $this->_num_ville;
}
public function nom_ville()
{ return $this->_nom_ville;
}


//setteur
public function setNum_ville($num_ville)
{ $this->_num_ville=$num_ville;
}
public function setNom_ville($nom_ville)
{ $this->_nom_ville=$nom_ville;
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


