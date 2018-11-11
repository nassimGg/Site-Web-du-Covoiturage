<?php 
session_start();
require_once ('dbconfig.php');
require_once('Reservation.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
require_once ('Administrateur.class.php');
require_once ('Administrateurmanager.class.php');
$manager=new ParticipantManager();
$manager1=new ConducteurManager();
$manager2=new AdministrateurManager();
$reservation=new Reservation();
$managert=new TrajetManager();
$villemanager=new VilleManager();
$villes=$villemanager->villelist();

if($manager1->is_loggedin() || $manager2->is_loggedin())
{$manager1->redirect('reservation_non_autorise.php');
$manager2->redirect('reservation_non_autorise.php');

}
elseif (!$manager1->is_loggedin()&& !$manager->is_loggedin()&& !$manager2->is_loggedin())
{session_start();

$_SESSION['num_trajet']=$_GET['num_trajet'];
	$_SESSION['reserv']=1;
	$_SESSION['place']=$_POST['places'.$_GET['num_trajet'].''];
	$manager1->redirect('login.php?reserv=oui');
	
}
else
{
	
if(isset($_POST['bouton_reservation']))
{$place=$_POST['places'.$_GET['num_trajet'].''];
	$part=$manager->get($_SESSION['user_part']);

	$trajet=$managert->get($_GET['num_trajet']);	
	if($reservation->reserver($part,$trajet,$place))
	{
		$y=$place;
		   $x=$trajet->nombre_place()-$y;
		   $trajet->setNombre_place($x);
		if($managert->modifier($trajet)){}
		
	}
}
if(isset($_GET['bouton']))
{$place=$_GET['place'];
	$part=$manager->get($_SESSION['user_part']);

	$trajet=$managert->get($_GET['num_trajet']);	
	if($reservation->reserver($part,$trajet,$place))
	{$y=$place;
		   $x=$trajet->nombre_place()-$y;
		   $trajet->setNombre_place($x);
		if($managert->modifier($trajet)){}
		
	}
}

		
}
?>


<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="refresh" content="5;URL=/ProjetFinEtude/participant.php">
<meta http-equiv="X-UA-Compatible" content="IE=edge">


<title>Réservation | ETU Covoiturage</title>
<link rel="icon" type="images/png" href="images/title.gif"/>

</head>
<body style="background-image:url(images/back_reserv.png);background-size:cover;width:99%;height:100%;background-repeat:no-repeat;">
<img src="images/reserv_succes.png" style="margin-left:250px;margin-top:100px;"/>';



</body>
</html>
