<?php 
require_once ('Conducteur.class.php');
require_once ('dbconfig.php');
// class conducteur manager consistea gérer les fonctionalits des trajets et pour gérer les objets trajet

class ConducteurManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
	}
//fonction qui permet d'inscrir un neuveau conducteur
	public function register(Conducteur $cond)
    {
       try
       {
           $stmt = $this->_db->prepare("INSERT INTO Conducteur(MP_conducteur,Email,Nom,Prenom,Sexe,Date_naissance,Date_inscription,Tel,Photo,Minibio,Preference) 
                                                       VALUES(:mp, :email, :nom, :prenom, :sexe, :date_nai, :date_insc, :tel, :photo, :minibio, :pref)");
              
           $stmt->bindValue(":mp", $cond->mp());
           $stmt->bindValue(":email", $cond->email());
           $stmt->bindValue(":nom",$cond->nom()); 
		   $stmt->bindValue(":prenom",$cond->prenom());
           $stmt->bindValue(":sexe", $cond->sexe());
           $stmt->bindValue(":date_nai",$cond->date_naissance());
		   $stmt->bindValue(":date_insc",$cond->date_inscription());
		   $stmt->bindValue(":tel",$cond->tel());
		   $stmt->bindValue(":pref","NFOMOA");
		   $stmt->bindValue(":photo",$cond->photo());
		   $stmt->bindValue(":minibio",$cond->minibio());
		               
           $stmt->execute(); 
		   $cond->hydrate(array('id' => $this->_db->lastInsertId()));
   $_SESSION['user_cond'] = $this->_db->lastInsertId();
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	//fonction qui permet de modifer les inormartions d'un conducteur spécifique
	public function modifier(Conducteur $cond)
    {
       try
       {
           $stmt = $this->_db->prepare("UPDATE Conducteur SET MP_conducteur=:mp, Email=:email, Nom=:nom,Prenom=:prenom
		   , Sexe=:sexe, Date_naissance=:date_nai, Date_inscription=:date_insc, Tel=:tel, Photo=:photo, Minibio=:minibio, Preference=:preference where ID_conducteur=:id");
              
           $stmt->bindValue(":mp", $cond->mp());
           $stmt->bindValue(":email", $cond->email());
           $stmt->bindValue(":nom",$cond->nom()); 
		   $stmt->bindValue(":prenom",$cond->prenom());
           $stmt->bindValue(":sexe", $cond->sexe());
           $stmt->bindValue(":date_nai",$cond->date_naissance());
		   $stmt->bindValue(":date_insc",$cond->date_inscription());
		   $stmt->bindValue(":tel",$cond->tel()); 
		   $stmt->bindValue(":id",$cond->id()); 
		   $stmt->bindValue(":photo",$cond->photo());
		   $stmt->bindValue(":minibio",$cond->minibio()); 
		   $stmt->bindValue(":preference",$cond->preference());           
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	
	//fonction qui retourne les informatiosn d'un conducteur spécifié par $id
	public function get($id)
	{
	       try
       {
          $stmt = $this->_db->prepare("SELECT ID_Conducteur,MP_Conducteur,Email,
		  Nom,Prenom,Sexe,Date_Naissance,Date_inscription,Tel,Photo,Minibio,Preference FROM Conducteur 
		   WHERE ID_Conducteur=:id");
          $stmt->execute(array(':id'=>$id));
          $donnees= $stmt->fetch(PDO::FETCH_ASSOC);
         
				$cond = new Conducteur(array('id'=>$donnees['ID_Conducteur'],'mp'=>$donnees['MP_Conducteur'],
				'email'=>$donnees['Email'],'nom'=>$donnees['Nom'],'prenom'=>$donnees['Prenom'],
				'sexe'=>$donnees['Sexe'],'date_naissance'=>$donnees['Date_Naissance'],
				'date_inscription'=>$donnees['Date_inscription'],'tel'=>$donnees['Tel'],'photo'=>$donnees['Photo']
				,'minibio'=>$donnees['Minibio'],'preference'=>$donnees['Preference']));
			
		return $cond;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	
	}
//fonction de login 
public function login(Conducteur $cond)
    {
       try
       {
          $stmt = $this->_db->prepare("SELECT * FROM Conducteur WHERE Email=:email");
          $stmt->execute(array(':email'=>$cond->email()));
          $userRow= $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() == 1)
          {
             if($cond->mp()==$userRow['MP_conducteur'])
             {
                $_SESSION['user_cond'] = $userRow['ID_conducteur'];
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
   
   //fonction qui retourne la liste des conducteurs
  public function getlist()
   {$cond=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT ID_conducteur,MP_conducteur,Email,Nom,Prenom,Sexe,Date_naissance,Date_inscription,Photo,Tel,Minibio,Preference FROM Conducteur ORDER by ID_conducteur");
		   $stmt->execute();
		   
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$cond[] = new Conducteur(array('id'=>$donnees['ID_conducteur'],'mp'=>$donnees['MP_conducteur'],
				'email'=>$donnees['Email'],'nom'=>$donnees['Nom'],'prenom'=>$donnees['Prenom'],
				'sexe'=>$donnees['Sexe'],'date_naissance'=>$donnees['Date_naissance'],'date_inscription'=>$donnees['Date_inscription'],
				'tel'=>$donnees['Tel'],'photo'=>$donnees['Photo'],'minibio'=>$donnees['Minibio']
				,'preference'=>$donnees['Preference']));
			}
		return $cond;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	   
   }
   
   //fonction qui supprime un conducteur
public function delete($info)
{
	 try
       {
           $stmt = $this->_db->prepare("DELETE FROM Conducteur where ID_conducteur=:id");
		   $stmt->bindValue(":id", $info);
		   $stmt->execute();
		   
		  
		return true;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
}

//fonction qui tester si un conducteur est connecter
 public function is_loggedin()
   {
      if(isset($_SESSION['user_cond']))
      {
         return true;
      }
   }
 
 //fonction qui redirect un conducteur vers un url 
   public function redirect($url)
   {
       header("Location: $url");
   }
 //fonctin pour déconnecter 
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_cond']);
        return true;
   }
}
?>



