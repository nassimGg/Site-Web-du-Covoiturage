<?php 
//class participant
class Participant
{ private $_id,$_mp,$_email,$_nom,$_prenom,
$_tel,$_sexe,$_date_naissance,$_date_inscription,$_photo,$_minibio;

//constructeur
 public function __construct(array $donnees)

  {
    $this->hydrate($donnees);
  }


//getteur 
public function id()
{ return $this->_id;
}
public function email()
{ return $this->_email;
}
public function mp()
{ return $this->_mp;
}	
public function nom()
{ return $this->_nom;
}	
public function prenom()
{ return $this->_prenom;
}	
public function sexe()
{ return $this->_sexe;
}
public function tel()
{ return $this->_tel;
}
public function date_naissance()
{ return $this->_date_naissance;
}
public function date_inscription()
{ return $this->_date_inscription;
}
public function photo()
{ return $this->_photo;
}
public function minibio()
{ return $this->_minibio;
}

//setteur
public function setId($id)
{ $this->_id=$id;
}
public function setEmail($email)
{ $this->_email=$email;
}
public function setSexe($sexe)
{ $this->_sexe=$sexe;
}
public function setMp($mp)
{ $this->_mp=$mp;
}
public function setNom($nom)
{ $this->_nom=$nom;
}
public function setPrenom($prenom)
{ $this->_prenom=$prenom;
}
public function setDate_naissance($date_naissance)
{ $this->_date_naissance=$date_naissance;
}
public function setDate_inscription($date_inscription)
{ $this->_date_inscription=$date_inscription;
}
public function setTel($tel)
{ $this->_tel=$tel;
}
public function setPhoto($photo)
{ $this->_photo=$photo;
}
public function setMini($minibio)
{ $this->_minibio=$minibio;
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