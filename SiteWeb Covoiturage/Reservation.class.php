<?php 
require_once('Trajet.class.php');
require_once('Participant.class.php');
require_once('Trajetmanager.class.php');
require_once('dbconfig.php');
// class Reservation consiste a gérer les fonctionalits des trajets et pour gérer les objets trajet

class Reservation
{ public $_db;
private $_nombre_place;

	public function __construct()
	{$database = new Database();
		$db = $database->dbConnection();
		$this->_db = $db;
	}
	
	//getteur
	public function nombre_place()
{ return $this->_nombre_place;
}

//setteur
public function setNombre_place($nombre_place)
{ $this->_nombre_place=$nombre_place;
}

//fonction qui permet de faire une réservation pour le particpant dans le trajet correspondant
public function reserver(Participant $part,Trajet $trajet,$nombre_place)
{
	try
       {
           $stmt = $this->_db->prepare("INSERT INTO Reservation(ID_participant,Num_trajet,Nombre_place) 
                                                       VALUES(:id_part, :num_trajet,:nombre_place)");
              
           $stmt->bindValue(":id_part", $part->id());
           $stmt->bindValue(":num_trajet", $trajet->num_trajet());
		   $stmt->bindValue(":nombre_place", $nombre_place);            
           $stmt->execute();
		   $managert=new TrajetManager();
		   
		   
		   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }	
}

//fonction qui permet d'annuler la réservation
public function desister(Participant $part,Trajet $trajet)
{
try
       {	$stm = $this->_db->prepare("SELECT Nombre_place FROM Reservation where ID_participant=:id and Num_trajet=:num_trajet ");
              
           $stm->bindValue(":id", $part->id()); 
		   $stm->bindValue(":num_trajet", $trajet->num_trajet()); 
           $stm->execute();
		   $userRow= $stm->fetch(PDO::FETCH_ASSOC);
		   $place=$userRow['Nombre_place'];
           $stmt = $this->_db->prepare("DELETE FROM Reservation where ID_participant=:id and Num_trajet=:num_trajet ");
              
           $stmt->bindValue(":id", $part->id()); 
		   $stmt->bindValue(":num_trajet", $trajet->num_trajet()); 
           $stmt->execute();
		   $x=$trajet->nombre_place()+$place;
		   $trajet->setNombre_place($x);
		   $stmt = $this->_db->prepare("UPDATE Trajet SET  Nombre_place=:nb_place where Num_Trajet=:num");
              
           $stmt->bindValue(":nb_place", $trajet->nombre_place()); 
		   $stmt->bindValue(":num", $trajet->num_trajet()); 
           $stmt->execute(); 
		   
           return true; 
       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }	
}	

//fonction qui retourner le nombre de réservation faite par un participant
public function countr($id){
	$stmt = $this->_db->prepare("SELECT COUNT(*) FROM Reservation where ID_participant=:id");
		   $stmt->bindValue(":id",$id); 
		   $stmt->execute();
	return $stmt->fetchColumn();
	
}

//fonction qui retourne la liste des réservations d'un participant
public function get($info)
{
	
$trajet=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT T.Num_Trajet,T.Type,T.Num_Ville1,T.Num_Ville2,T.Date_aller,T.Date_retour,T.Heure_retour,T.Heure_aller,T.Prix,T.ID_conducteur,T.Nombre_place FROM Trajet T,Reservation R where T.Num_Trajet=R.Num_trajet and R.ID_participant=:id");
		   $stmt->bindValue(":id",$info); 
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$trajet[] = new Trajet(array('num_trajet'=>$donnees['Num_Trajet'],'type'=>$donnees['Type'],'num_ville1'=>$donnees['Num_Ville1'],
				'num_ville2'=>$donnees['Num_Ville2'],'date_aller'=>$donnees['Date_aller'],'heure_aller'=>$donnees['Heure_aller']
				,'prix'=>$donnees['Prix'],'id_conducteur'=>$donnees['ID_conducteur'],'nombre_place'=>$donnees['Nombre_place']
				,'date_retour'=>$donnees['Date_retour'],'heure_retour'=>$donnees['Heure_retour']));
			}
		return $trajet;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }

}

//fonction qui reoturne les participants qui sont réservés dans une trajets a partir de son id
public function getp($info)
{
	
$participants=array();
	 try
       {
           $stmt = $this->_db->prepare("SELECT P.ID_participant,P.MP_participant,P.Nom,P.Prenom,P.Email,P.Photo FROM Participant P,Reservation R where R.Num_trajet=:num and P.ID_participant=R.ID_participant");
		   $stmt->bindValue(":num",$info); 
		   $stmt->execute();
		   while ($donnees = $stmt->fetch(PDO::FETCH_ASSOC))
			{
				$participants[] = new Participant(array('id'=>$donnees['ID_participant'],'mp'=>$donnees['MP_participant'],'nom'=>$donnees['Nom'],
				'prenom'=>$donnees['Prenom'],'email'=>$donnees['Email'],'photo'=>$donnees['Photo']));
			}
		return $participants;

       }
       catch(PDOException $e)
       {
           echo $e->getMessage();
       }

}


}
?>