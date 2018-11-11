<?php 
require_once ('Participant.class.php');
require_once ('dbconfig.php');
// class participant manager consistea gérer les fonctionalits des trajets et pour gérer les objets trajet

class ParticipantManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
	}

//fonction qui permet d'inscrir un neuveau participant

	public function register(Participant $part)
    {
       try
       {
           $stmt = $this->_db->prepare("INSERT INTO Participant(MP_participant,Email,Nom,Prenom,Sexe,Date_naissance,Date_inscription,Tel,Photo,Minibio) 
                                                       VALUES(:mp, :email, :nom, :prenom, :sexe, :date_nai, :date_insc, :tel, :photo, :minibio)");
              
           $stmt->bindValue(":mp", $part->mp());
           $stmt->bindValue(":email", $part->email());
           $stmt->bindValue(":nom",$part->nom()); 
		   $stmt->bindValue(":prenom",$part->prenom());
           $stmt->bindValue(":sexe", $part->sexe());
           $stmt->bindValue(":date_nai",$part->date_naissance());
		   $stmt->bindValue(":date_insc",$part->date_inscription());
		   $stmt->bindValue(":tel",$part->tel()); 
		   $stmt->bindValue(":photo",$part->photo()); 
		   $stmt->bindValue(":minibio",$part->minibio());            
           $stmt->execute(); 
		   $part->hydrate(array('id' => $this->_db->lastInsertId()));
   			$_SESSION['user_part'] = $this->_db->lastInsertId();
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		//fonction qui permet de modifer les inormartions d'un participant spécifique

	public function modifier(Participant $part)
    {
       try
       {
           $stmt = $this->_db->prepare("UPDATE Participant SET MP_participant=:mp, Email=:email, Nom=:nom,Prenom=:prenom
		   , Sexe=:sexe, Date_naissance=:date_nai, Date_inscription=:date_insc, Tel=:tel, Photo=:photo,Minibio=:minibio where ID_participant=:id");
              
           $stmt->bindValue(":mp", $part->mp());
           $stmt->bindValue(":email", $part->email());
           $stmt->bindValue(":nom",$part->nom()); 
		   $stmt->bindValue(":prenom",$part->prenom());
           $stmt->bindValue(":sexe", $part->sexe());
           $stmt->bindValue(":date_nai",$part->date_naissance());
		   $stmt->bindValue(":date_insc",$part->date_inscription());
		   $stmt->bindValue(":tel",$part->tel()); 
		   $stmt->bindValue(":id",$part->id()); 
		   $stmt->bindValue(":photo",$part->photo());
		   $stmt->bindValue(":minibio",$part->minibio());            
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
		//fonction qui retourne les informatiosn d'un participant spécifié par $id

	public function get($id)
	{
	       try
       {
          $stmt = $this->_db->prepare("SELECT ID_participant,MP_participant,Email,
		  Nom,Prenom,Sexe,Date_Naissance,Date_inscription,Tel,Photo,Minibio FROM Participant 
		   WHERE ID_participant=:id");
          $stmt->execute(array(':id'=>$id));
          $donnees= $stmt->fetch(PDO::FETCH_ASSOC);
         
				$part = new Participant(array('id'=>$donnees['ID_participant'],'mp'=>$donnees['MP_participant'],
				'email'=>$donnees['Email'],'nom'=>$donnees['Nom'],'prenom'=>$donnees['Prenom'],
				'sexe'=>$donnees['Sexe'],'date_naissance'=>$donnees['Date_Naissance'],'date_inscription'=>$donnees['Date_inscription'],'tel'=>$donnees['Tel'],'photo'=>$donnees['Photo'],'minibio'=>$donnees['Minibio']));
			
		return $part;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	
	}
//fonction de login 

public function login(Participant $part)
    {
       try
       {
          $stmt = $this->_db->prepare("SELECT * FROM participant WHERE Email=:email");
          $stmt->execute(array(':email'=>$part->email()));
          $userRow= $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() == 1)
          {
             if($part->mp()==$userRow['MP_participant'])
             {
                $_SESSION['user_part'] = $userRow['ID_participant'];
                return true;
             }
             else
             {
                return false;
             }
          }
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
   }
   
      //fonction qui retourne la liste des participants

   public function getlist()
   {$part=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT ID_participant,MP_participant,Email,Nom,Prenom,Sexe,Date_Naissance,Date_inscription,Tel,Photo,Minibio FROM Participant ORDER by ID_participant");
		   $stmt->execute();
		   
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$part[] = new Participant(array('id'=>$donnees['ID_participant'],'mp'=>$donnees['MP_participant'],
				'email'=>$donnees['Email'],'nom'=>$donnees['Nom'],'prenom'=>$donnees['Prenom'],
				'sexe'=>$donnees['Sexe'],'date_naissance'=>$donnees['Date_Naissance'],'date_inscription'=>$donnees['Date_inscription'],'tel'=>$donnees['Tel'],'photo'=>$donnees['Photo'],'minibio'=>$donnees['Minibio']));
			}
		return $part;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	   
   }
//fonction qui tester si un participant est connecter

 public function is_loggedin()
   {
      if(isset($_SESSION['user_part']))
      {
         return true;
      }
   }
  //fonction qui redirect un participant vers un url 

   public function redirect($url)
   {
       header("Location: $url");
   }
  //fonction pour déconnecter 

   public function logout()
   {
        session_start();
session_destroy();
$_SESSION = array();
        return true;
   }
      //fonction qui supprime un conducteur

public function delete($info)
{
	 try
       {
           $stmt = $this->_db->prepare("DELETE FROM Participant where ID_participant=:id");
		   $stmt->bindValue(":id", $info);
		   $stmt->execute();
		   
		  
		return true;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
}

}

?>