<?php 
require_once ('Ville.class.php');
require_once ('dbconfig.php');
// class Ville manager consistea gérer les fonctionalits des trajets et pour gérer les objets trajet

class VilleManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
}

//fonction qui permet d'ajouter un ville
public function add(Ville $ville)
    {
       try
       {
           $stmt = $this->_db->prepare("INSERT INTO Ville(Nom_ville) VALUES(:nom)");
              
           $stmt->bindValue(":nom", $ville->nom_ville());           
           $stmt->execute(); 
		   $part->hydrate(array('num_ville' => $this->_db->lastInsertId()));
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
//fonction qui reoturne la liste des villes
public function villelist()
{
	$villes=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT * FROM Ville");
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$villes[] = new Ville($donnees);
			}
		return $villes;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
//fonction qui permet de retournerl numéro d'une ville a partir de son nom
public function get($info)
{
	try
       {
           $stmt = $this->_db->prepare("SELECT * FROM Ville where Nom_Ville=:ville");
		   $stmt->bindValue(":ville", $info);
		   $stmt->execute();
		   $userRow= $stmt->fetch(PDO::FETCH_ASSOC);
		return $userRow['Num_Ville'];

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
	 
}
//fonction qui retourne le nom d'une ville a partir de son numéro
public function getn($info)
{
	try
       {
           $stmt = $this->_db->prepare("SELECT * FROM Ville where Num_Ville=:ville");
		   $stmt->bindValue(":ville", $info);
		   $stmt->execute();
		   $userRow= $stmt->fetch(PDO::FETCH_ASSOC);
		return $userRow['Nom_Ville'];

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
	 
}
//fonction qui permet de modifier les informations d'une ville
public function modifier(Ville $ville)
    {
       try
       {
           $stmt = $this->_db->prepare("UPDATE Ville SET Nom_Ville=:ville where Num_Ville=:num");
              
           $stmt->bindValue(":ville",$ville->num_ville());
           $stmt->bindValue(":num",$ville->nom_ville());            
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }    
    }
	//fonction qui permet de supprimer une ville
	public function delete(Ville $ville)
{
	try
       {
           $stmt = $this->_db->prepare("DELETE FROM Ville where Num_Ville=:num");
              
           $stmt->bindValue(":num", $ville->num_ville());           
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