<?php 
require_once ('Trajet.class.php');
require_once ('dbconfig.php');

// class trajets manager consistea gérer les fonctionalits des trajets et pour gérer les objets trajet
class TrajetManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
}
// fonction qui permet d'ajouter un trajet qui contient comme argumet objet trajet 
public function addtrajet(Trajet $trajet)
{
	 try
       {
           $stmt = $this->_db->prepare("INSERT INTO Trajet(Type,Num_Ville1,Num_Ville2,Date_aller,Date_retour,Heure_aller,Heure_retour,Prix,Nombre_place,ID_conducteur,Description) 
                                                       VALUES(:type, :num_ville1, :num_ville2, :date_aller, :date_retour, :heure_aller, :heure_retour, :prix, :nombre_place,:id_conducteur,:description)");
		   $stmt->bindValue(":type", $trajet->type());
		   $stmt->bindValue(":num_ville1", $trajet->num_ville1());
           $stmt->bindValue(":num_ville2", $trajet->num_ville2());
           $stmt->bindValue(":date_aller",$trajet->date_aller()); 
		   $stmt->bindValue(":date_retour",$trajet->date_retour());
           $stmt->bindValue(":heure_aller", $trajet->heure_aller());
           $stmt->bindValue(":heure_retour",$trajet->heure_retour());
		   $stmt->bindValue(":prix",$trajet->prix());
		   $stmt->bindValue(":nombre_place",$trajet->nombre_place());
		   $stmt->bindValue(":id_conducteur",$trajet->id_conducteur()); 
		    $stmt->bindValue(":description",$trajet->description());            
           $stmt->execute(); 
		   $trajet->hydrate(array('num_trajet' => $this->_db->lastInsertId()));
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	//fonction qui retourne la liste des trajet pour un conducteur specifique
public function listtrajet($info)
{
	
	$trajets=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT * FROM Trajet where ID_conducteur=:id");
		   $stmt->bindValue(":id",$info); 
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$trajets[] = new Trajet($donnees);
			}
		return $trajets;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
}

//fonction qui permet de supprimer un trajet 
public function delete(Trajet $trajet)
{
	try
       {
           $stmt = $this->_db->prepare("DELETE FROM Trajet where Num_Trajet=:num");
              
           $stmt->bindValue(":num", $trajet->num_trajet());           
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
}


//fonction qui retourne la liste de tous les trajets 
public function getlist()
   {$trajet=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT Num_Trajet,Type,Num_Ville1,Num_Ville2,Date_aller,Date_retour,Heure_aller
		   ,Heure_retour,Prix,Nombre_place,ID_conducteur,Description FROM Trajet ORDER by Num_trajet");
		   $stmt->execute();
		   
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$trajet[] = new Trajet(array('num_trajet'=>$donnees['Num_Trajet'],'type'=>$donnees['Type'],
				'num_ville1'=>$donnees['Num_Ville1'],'num_ville2'=>$donnees['Num_Ville2'],'date_aller'=>$donnees['Date_aller'],
				'date_retour'=>$donnees['Date_retour'],'heure_aller'=>$donnees['Heure_aller'],'heure_retour'=>$donnees['Heure_retour'],
				'prix'=>$donnees['Prix'],'nombre_place'=>$donnees['Nombre_place'],'id_conducteur'=>$donnees['ID_conducteur']
				,'description'=>$donnees['Description']));
			}
		return $trajet;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	     }
		 
		 //fonction qui retourne les 12 dernieres trajets 
		 public function getall()
   {$trajet=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT Num_Trajet,Type,Num_Ville1,Num_Ville2,Date_aller,Date_retour,Heure_aller
		   ,Heure_retour,Prix,Nombre_place,ID_conducteur,Description FROM Trajet ORDER BY Num_Trajet DESC LIMIT 12");
		   $stmt->execute();
		   
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$trajet[] = new Trajet(array('num_trajet'=>$donnees['Num_Trajet'],'type'=>$donnees['Type'],
				'num_ville1'=>$donnees['Num_Ville1'],'num_ville2'=>$donnees['Num_Ville2'],'date_aller'=>$donnees['Date_aller'],
				'date_retour'=>$donnees['Date_retour'],'heure_aller'=>$donnees['Heure_aller'],'heure_retour'=>$donnees['Heure_retour'],
				'prix'=>$donnees['Prix'],'nombre_place'=>$donnees['Nombre_place'],'id_conducteur'=>$donnees['ID_conducteur']
				,'description'=>$donnees['Description']));
			}
		return $trajet;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	     }

//fonction qui permet de faire une recherche sur des trajets 
public function recherche(Trajet $tr)
   {$trajet=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT Num_Trajet,Type,Num_Ville1,Num_Ville2,Date_aller,Date_retour,Heure_aller
		   ,Heure_retour,Prix,Nombre_place,ID_conducteur,Description FROM Trajet where Num_Ville1=:ville1 and Num_Ville2=:ville2 and Date_aller=:date ");
		   $stmt->bindValue(":ville1",$tr->num_ville1());
		   $stmt->bindValue(":ville2",$tr->num_ville2());
		   $stmt->bindValue(":date",$tr->date_aller());
		   $stmt->execute();
		   
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$trajet[] = new Trajet(array('num_trajet'=>$donnees['Num_Trajet'],'type'=>$donnees['Type'],
				'num_ville1'=>$donnees['Num_Ville1'],'num_ville2'=>$donnees['Num_Ville2'],'date_aller'=>$donnees['Date_aller'],
				'date_retour'=>$donnees['Date_retour'],'heure_aller'=>$donnees['Heure_aller'],'heure_retour'=>$donnees['Heure_retour'],
				'prix'=>$donnees['Prix'],'nombre_place'=>$donnees['Nombre_place'],'id_conducteur'=>$donnees['ID_conducteur']
				,'description'=>$donnees['Description']));
			}
		return $trajet;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	   
   }
 // fonction qui reoturne les informations d'un trajet spécifique 
 public function get($info)
   {
	 try 
       {
           $stmt = $this->_db->prepare("SELECT Num_Trajet,Type,Num_Ville1,Num_Ville2,Date_aller,Date_retour,Heure_aller
		   ,Heure_retour,Nombre_place,Prix,ID_conducteur,Description FROM Trajet where Num_Trajet=:num");
		   $stmt->bindValue(":num",$info);
		   $stmt->execute();
		   
		   $donnees= $stmt->fetch(PDO::FETCH_ASSOC);
				$trajet = new Trajet(array('num_trajet'=>$donnees['Num_Trajet'],'type'=>$donnees['Type'],
				'num_ville1'=>$donnees['Num_Ville1'],'num_ville2'=>$donnees['Num_Ville2'],'nombre_place'=>$donnees['Nombre_place'],'date_aller'=>$donnees['Date_aller'],
				'date_retour'=>$donnees['Date_retour'],'heure_aller'=>$donnees['Heure_aller'],'heure_retour'=>$donnees['Heure_retour'],
				'prix'=>$donnees['Prix'],'id_conducteur'=>$donnees['ID_conducteur']
				,'description'=>$donnees['Description']));
			
		return $trajet;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	     }
		 	//fonction qui retourne la liste des trajet pour un conducteur specifique
		  public function gett($info)
   {$trajet=array();
	 try 
       {
           $stmt = $this->_db->prepare("SELECT Num_Trajet,Type,Num_Ville1,Num_Ville2,Date_aller,Date_retour,Heure_aller
		   ,Heure_retour,Nombre_place,Prix,ID_conducteur,Description FROM Trajet where ID_conducteur=:num");
		   $stmt->bindValue(":num",$info);
		   $stmt->execute();
		   
		   
		    while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$trajet[] = new Trajet(array('num_trajet'=>$donnees['Num_Trajet'],'type'=>$donnees['Type'],
				'num_ville1'=>$donnees['Num_Ville1'],'num_ville2'=>$donnees['Num_Ville2'],'date_aller'=>$donnees['Date_aller'],
				'date_retour'=>$donnees['Date_retour'],'heure_aller'=>$donnees['Heure_aller'],'heure_retour'=>$donnees['Heure_retour'],
				'prix'=>$donnees['Prix'],'nombre_place'=>$donnees['Nombre_place'],'id_conducteur'=>$donnees['ID_conducteur']
				,'description'=>$donnees['Description']));
			}
		return $trajet;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	     }
		 
	//fonction qui permet de modifer les données  d'un trajet	 
		 public function modifier(Trajet $trajet)
   {
	 try 
       {
           $stmt = $this->_db->prepare("UPDATE Trajet SET  Num_Ville1=:num_ville1 , Num_Ville2=:num_ville2
		   ,Date_aller=:date_aller, Date_retour=:date_retour ,Heure_aller=:heure_aller
		   ,Heure_retour=:heure_retour ,Nombre_place=:nombre_place ,Prix=:prix ,ID_conducteur=:id_conducteur,
		   Description=:description where Num_Trajet=:num");
		   
		   $stmt->bindValue(":num_ville1", $trajet->num_ville1());
           $stmt->bindValue(":num_ville2", $trajet->num_ville2());
           $stmt->bindValue(":date_aller",$trajet->date_aller()); 
		   $stmt->bindValue(":date_retour",$trajet->date_retour());
           $stmt->bindValue(":heure_aller", $trajet->heure_aller());
           $stmt->bindValue(":heure_retour",$trajet->heure_retour());
		   $stmt->bindValue(":prix",$trajet->prix());
		   $stmt->bindValue(":nombre_place",$trajet->nombre_place());
		   $stmt->bindValue(":id_conducteur",$trajet->id_conducteur());  
		   $stmt->bindValue(":description",$trajet->description());            
		   $stmt->bindValue(":num",$trajet->num_trajet());
		   $stmt->execute();
		 
		return true;
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
	     }  
//focntion qui retourne le nombre des trajets publier par un condcuteur specifique
public function countt($info)
{			$stmt = $this->_db->prepare("SELECT COUNT(*) FROM Trajet where ID_conducteur=:id");
		   $stmt->bindValue(":id",$info); 
		   $stmt->execute();
	return $stmt->fetchColumn();
}

}

?>