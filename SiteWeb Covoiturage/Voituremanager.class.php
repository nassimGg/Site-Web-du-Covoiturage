<?php 
require_once ('Voiture.class.php');
require_once ('dbconfig.php');

// class voiture manager consistea gérer les fonctionalits des trajets et pour gérer les objets trajet

class VoitureManager
{ public $_db;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
	}
	
//fonction qui permet d'ajouter une voiture
public function add(Voiture $voit)
{
try
       {
           $stmt = $this->_db->prepare("INSERT INTO Voiture(Num_immatriculation,Marque,Annee,Kilometrage,Nb_place,Couleur,ID_conducteur) 
                                                       VALUES(:num_imm, :marque, :annee, :kilo, :nb_place, :couleur, :id_conducteur)");
              
           $stmt->bindValue(":num_imm", $voit->num_imm());
           $stmt->bindValue(":marque", $voit->marque());
           $stmt->bindValue(":annee",$voit->annee()); 
		   $stmt->bindValue(":kilo",$voit->kilometrage());
           $stmt->bindValue(":nb_place", $voit->nb_place());
           $stmt->bindValue(":couleur",$voit->couleur());
		   $stmt->bindValue(":id_conducteur",$voit->id_conducteur());            
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 	
	
	
}
//fonction qui permet de supprimer une voiture
public function delete(Voiture $voit)
{
	try
       {
           $stmt = $this->_db->prepare("DELETE FROM Voiture where Num_immatriculation=:num_imm");
              
           $stmt->bindValue(":num_imm", $voit->num_imm());           
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
}

//fonction qui permet de modifier les informations d'une voiture
public function update(Voiture $voit)
{

try
       {
           $stmt = $this->_db->prepare("UPDATE Voiture SET Marque=:marque, Annee=:annee, Kilometrage=:kilo,Nb_place=:nb_place
		   , Couleur=:couleur,Photo=:photo where Num_immatriculation=:num_imm and ID_conducteur=:id_conducteur");
		   
          $stmt->bindValue(":num_imm", $voit->num_imm());
           $stmt->bindValue(":marque", $voit->marque());
           $stmt->bindValue(":annee",$voit->annee()); 
		   $stmt->bindValue(":kilo",$voit->kilometrage());
           $stmt->bindValue(":nb_place", $voit->nb_place());
           $stmt->bindValue(":couleur",$voit->couleur());
		   $stmt->bindValue(":id_conducteur",$voit->id_conducteur());
		   $stmt->bindValue(":photo",$voit->photo());            
           $stmt->execute(); 
   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }	
}
//fonction qui retourne la liste des voiture d'un conducteur
public function getlist($info)
{
	$voitures=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT * FROM Voiture where ID_conducteur=:id");
		   $stmt->bindValue(":id",$info); 
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$voitures[] = new Voiture(array('num_imm'=>$donnees['Num_immatriculation'],'marque'=>$donnees['Marque'],'annee'=>$donnees['Annee']
				,'kilometrage'=>$donnees['Kilometrage'],'nb_place'=>$donnees['Nb_place'],'couleur'=>$donnees['Couleur']
				,'id_conducteur'=>$donnees['ID_conducteur'],'photo'=>$donnees['Photo']));
			}
		return $voitures;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       } 
}
//fonction qui retourne le nombre de voiture d'un conducteur
public function countV($info)
{			$stmt = $this->_db->prepare("SELECT COUNT(*) FROM Voiture where ID_conducteur=:id");
		   $stmt->bindValue(":id",$info); 
		   $stmt->execute();
	return $stmt->fetchColumn();
}

}


?>