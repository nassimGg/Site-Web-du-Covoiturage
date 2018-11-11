<?php 
require_once ('Commentaire.class.php');
require_once ('dbconfig.php');
// class Commentaire manager consistea gérer les fonctionalits des trajets et pour gérer les objets trajet

class CommentaireManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
	}
	
//fonction qui permet d'ajouter un commentaire
public function add(Commentaire $comm)
{try
       {
           $stmt = $this->_db->prepare("INSERT INTO Commentaire(Contenu_commentaire,Date_commentaire,
		   ID_participant,ID_conducteur,Num_trajet) 
                                                       VALUES(:contenu, :date_comm, :id_participant,
													    :id_conducteur, :num_trajet)");
              
           
           $stmt->bindValue(":contenu", $comm->contenu());
           $stmt->bindValue(":date_comm",$comm->date_comm()); 
		   $stmt->bindValue(":id_participant",$comm->id_participant());
           $stmt->bindValue(":id_conducteur", $comm->id_conducteur());
           $stmt->bindValue(":num_trajet",$comm->num_trajet());            
           $stmt->execute(); 
		   $comm->hydrate(array('id_commentaire' => $this->_db->lastInsertId()));
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 	
	
}
//fonction qui permet de supprimer un commentaire
public function delete(Commentaire $comm)
{

	try
       {
           $stmt = $this->_db->prepare("DELETE FROM Commentaire where ID_commentaire=:id_comm ");
              
           $stmt->bindValue(":id_comm", $comm->id_commentaire());           
           $stmt->execute(); 
   
           return $stmt; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
}


//fonction qui reotune les commentaires pour un trajet
public function getlist($info)
{
	
	$commentaires=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT ID_commentaire,Contenu_commentaire,Date_commentaire,
		   ID_participant,ID_conducteur,Num_trajet FROM Commentaire where Num_trajet=:num_trajet");
		   $stmt->bindValue(":num_trajet",$info); 
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$commentaires[] = new Commentaire(array('id_commentaire'=>$donnees['ID_commentaire'],'contenu'=>$donnees['Contenu_commentaire'],
				'date_comm'=>$donnees['Date_commentaire'],'id_participant'=>$donnees['ID_participant'],'id_conducteur'=>$donnees['ID_conducteur'],
				'num_trajet'=>$donnees['Num_trajet']));
			}
		return $commentaires;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	
}

//fonction qui reoturne les informations d'un commentaire
public function get($info)
{
	
	
	 try
       {
           $stmt = $this->_db->prepare("SELECT ID_commentaire,Contenu_commentaire,Date_commentaire,
		   ID_participant,ID_conducteur,Num_trajet FROM Commentaire where ID_commentaire=:num");
		   $stmt->bindValue(":num",$info); 
		   $stmt->execute();
		   $donnees = $stmt->fetch(PDO::FETCH_ASSOC);
			
				$commentaire = new Commentaire(array('id_commentaire'=>$donnees['ID_commentaire'],'contenu'=>$donnees['Contenu_commentaire'],
				'date_comm'=>$donnees['Date_commentaire'],'id_participant'=>$donnees['ID_participant'],'id_conducteur'=>$donnees['ID_conducteur'],
				'num_trajet'=>$donnees['Num_trajet']));
			
		return $commentaire;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	
}
//fonction qui reoturne la liste de tous les commentaires
public function listc()
{
	
	$commentaires=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT ID_commentaire,Contenu_commentaire,Date_commentaire,
		   ID_participant,ID_conducteur,Num_trajet FROM Commentaire"); 
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$commentaires[] = new Commentaire(array('id_commentaire'=>$donnees['ID_commentaire'],'contenu'=>$donnees['Contenu_commentaire'],
				'date_comm'=>$donnees['Date_commentaire'],'id_participant'=>$donnees['ID_participant'],'id_conducteur'=>$donnees['ID_conducteur'],
				'num_trajet'=>$donnees['Num_trajet']));
			}
		return $commentaires;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }
	
}
}
?>