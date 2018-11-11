<?php 
//class trajet 
class Trajet
{ private $_num_trajet,$_type,$_num_ville1,$_numville2,$_date_aller,$_date_retour,
$_heure_aller,$_heure_retour,$_prix,$_nombre_place,$_id_conducteur,$_description;

//constructeur
 public function __construct(array $donnees)

  {
    $this->hydrate($donnees);
  }


//getteur 
public function num_trajet()
{ return $this->_num_trajet;
}
public function type()
{ return $this->_type;
}
public function num_ville1()
{ return $this->_num_ville1;
}
public function num_ville2()
{ return $this->_num_ville2;
}	
public function date_aller()
{ return $this->_date_aller;
}	
public function date_retour()
{ return $this->_date_retour;
}	
public function heure_aller()
{ return $this->_heure_aller;
}
public function heure_retour()
{ return $this->_heure_retour;
}
public function prix()
{ return $this->_prix;
}
public function nombre_place()
{ return $this->_nombre_place;
}
public function id_conducteur()
{ return $this->_id_conducteur;
}
public function description()
{ return $this->_description;
}

//setteur
public function setNum_trajet($num_trajet)
{ $this->_num_trajet=$num_trajet;
}
public function setNum_ville1($num_ville1)
{ $this->_num_ville1=$num_ville1;
}
public function setNum_ville2($num_ville2)
{ $this->_num_ville2=$num_ville2;
}
public function setType($type)
{ $this->_type=$type;
}
public function setDate_aller($date_aller)
{ $this->_date_aller=$date_aller;
}
public function setDate_retour($date_retour)
{ $this->_date_retour=$date_retour;
}
public function setHeure_aller($heure_aller)
{ $this->_heure_aller=$heure_aller;
}
public function setHeure_retour($heure_retour)
{ $this->_heure_retour=$heure_retour;
}
public function setPrix($prix)
{ $this->_prix=$prix;
}
public function setNombre_place($nombre_place)
{ $this->_nombre_place=$nombre_place;
}
public function setId_conducteur($Id_conducteur)
{ $this->_id_conducteur=$Id_conducteur;
}
public function setDescription($description)
{ $this->_description=$description;
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


