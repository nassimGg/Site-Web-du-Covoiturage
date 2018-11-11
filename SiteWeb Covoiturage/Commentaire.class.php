<?php 
//class commentaire
class Commentaire
{private $_id_commentaire,$_contenu,$_date_comm,$_id_participant,$_id_conducteur,$_num_trajet;

//constructeur
 public function __construct(array $donnees)

  {
    $this->hydrate($donnees);
  }
  
//getteur
public function id_commentaire()
{ return $this->_id_commentaire;
}
public function contenu()
{ return $this->_contenu;
}
public function date_comm()
{ return $this->_date_comm;
}
public function id_participant()
{ return $this->_id_participant;
}	
public function id_conducteur()
{ return $this->_id_conducteur;
}	
public function num_trajet()
{ return $this->_num_trajet;
}	


//setteur
public function setId_commentaire($id_commentaire)
{ $this->_id_commentaire=$id_commentaire;
}
public function setContenu($contenu)
{ $this->_contenu=$contenu;
}
public function setDate_comm($annee)
{ $this->_date_comm=$annee;
}
public function setId_participant($id_participant)
{ $this->_id_participant=$id_participant;
}
public function setId_conducteur($id_conducteur)
{ $this->_id_conducteur=$id_conducteur;
}
public function setNum_trajet($num_trajet)
{ $this->_num_trajet=$num_trajet;
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