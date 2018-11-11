<?php 
//class administrateur
class Administrateur 
{private $_id,$_mp,$_email;

//constructeur
public function __construct(array $donnees)

  {
    $this->hydrate($donnees);
  }

//getteur
public function id()
{ return $this->_id;
}
public function mp()
{ return $this->_mp;
}
public function email()
{ return $this->_email;
}

//setteur
public function setId($id)
{ $this->_id=$id;
}
public function setMp($mp)
{ $this->_mp=$mp;
}
public function setEmail($email)
{ $this->_email=$email;
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