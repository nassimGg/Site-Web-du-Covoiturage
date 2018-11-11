<?php 
require_once('dbconfig.php');
require_once('Administrateur.class.php');
// class Administrateur manager consistea gérer les fonctionalits des trajets et pour gérer les objets administrateur

class AdministrateurManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
	}
	
	//fonction login 
	public function login(Administrateur $admin)
	{
		       try
       {
          $stmt = $this->_db->prepare("SELECT * FROM Administrateur WHERE Email=:email");
          $stmt->execute(array(':email'=>$admin->email()));
          $userRow= $stmt->fetch(PDO::FETCH_ASSOC);
          if($stmt->rowCount() == 1)
          {
             if($admin->mp()==$userRow['MP_admin'])
             {
                $_SESSION['user_admin'] = $userRow['ID_admin'];
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
	
	//fonction tester si administrateur est connecter
	 public function is_loggedin()
   {
      if(isset($_SESSION['user_admin']))
      {
         return true;
      }
   }
   //fonction qui permet de récupere les informations de l'admin
 public function get($id)
	{
	       try
       {
          $stmt = $this->_db->prepare("SELECT * FROM Administrateur 
		   WHERE ID_admin=:id");
		   $stmt->bindValue(':id',$id);
          $stmt->execute();
          $donnees= $stmt->fetch(PDO::FETCH_ASSOC);
         
				$admin = new Administrateur(array('id'=>$donnees['ID_admin'],'mp'=>$donnees['MP_admin'],
				'email'=>$donnees['Email']));
			
		return $admin;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	
	}
   //fonction qui redirect un administrateur vers un url 

   public function redirect($url)
   {
       header("Location: $url");
   }
 //fonction déconnecter
   public function logout()
   {
        session_destroy();
        unset($_SESSION['user_admin']);
        return true;
   }
//fonction qui permet de modifier les informations de l'administrateur
public function modifier(Administrateur $admin)
    {
       try
       {
           $stmt = $this->_db->prepare("UPDATE Administrateur SET MP_admin=:mp, Email=:email where ID_admin=:id");
              
           $stmt->bindValue(":mp",$admin->mp());
           $stmt->bindValue(":email",$admin->email());
		   $stmt->bindValue(":id",$admin->id());            
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