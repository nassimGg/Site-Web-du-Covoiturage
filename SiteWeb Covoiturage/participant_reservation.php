<?php 
session_start();
// fonction pour calculer l'age
function age($naiss) {
list($annee, $mois, $jour) = explode('-', $naiss);
$today['mois'] = date('n');
$today['jour'] = date('j');
$today['annee'] = date('Y');
$annees = $today['annee'] - $annee;
if ($today['mois'] <= $mois) {
if ($mois == $today['mois']) {
if ($jour > $today['jour'])
$annees--;
}
else
$annees--;
}
return $annees;
}
// fin fonction
require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
require_once ('Commentairemanager.class.php');
require_once ('Commentaire.class.php');
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
require_once ('Reservation.class.php');
$managerco=new CommentaireManager();
$managerc=new ConducteurManager();
$managerp=new ParticipantManager();
$managervo=new VoitureManager();
$managerreserv=new Reservation();
$managerville=new VilleManager();
$managert=new TrajetManager();
$id=1;
$reservation=$managerreserv->get($id);
$participant=$managerp->get($id);
foreach($reservation as $reserv)
{// suppression d'une réservation
	if(isset($_POST['bouton_supp'.$reserv->num_trajet().'']))
	{$trajet=$managert->get($reserv->num_trajet());
	if($managerreserv->desister($participant,$trajet))
	{$_SESSION['supp_reserv']=1;
	$managerp->redirect('participant_reservation.php');
	}
	}
	
}
if(isset($_POST['bouton_commentaire']))
{
//ajouter un commentaire

	$commentaire=new Commentaire(array('contenu'=>utf8_decode($_POST['contenu']),'date_comm'=>date("Y-m-d"),'id_participant'=>$participant->id(),'num_trajet'=>$_GET['num']));
	if($managerco->add($commentaire)){
	}
}
$comment=$managerco->listc();
foreach($comment as $commen)
{//supprimer un commentaire
if(isset($_POST['bouton_supp_comm'.$commen->id_commentaire().'']))
{
	if($managerco->delete($commen))
	{	
	
	}

}}

?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Réservation | EtuCovoiturage</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">

<link rel="icon" type="images/png" href="images/title.gif"/>
<!-- Font awesome -->
        <link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">
<!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
<!-- Theme style -->
    <link rel="stylesheet" href="css/profil.min.css">
    
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <!-- pour Calendrier datepicker -->
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">

  <script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
  </head>

  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
<!-- tête principal -->
      <header class="main-header">
<!-- Logo -->
        <a href="index_profil_passager.php" class="logo">
        <!-- Mini logo -->
          <span class="logo-mini"><b>EC</b></span>
          <span class="logo-lg"><b>E</b>tu<b>C</b>ovoiturage</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
          </a>
        <!-- barre navigation -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              <li class="dropdown user user-menu">
  
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
                  <img src="profil_photo/<?php echo $participant->photo();?>" class="user-image" alt="User Image">
              
                  <span class="hidden-xs"><?php echo ucfirst($participant->prenom());?></span>
                </a>
                <ul class="dropdown-menu">
         
                  <li class="user-header">
                    <img src="profil_photo/<?php echo $participant->photo();?>" class="img-circle" alt="User Image">
                    <p>
                     <?php echo ucfirst($participant->prenom()).' '.ucfirst($participant->nom());?>
                     
                    </p>
                  </li>
                
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="participant_information.php" class="btn btn-default btn-flat">Profil</a>
                    </div>
                    <div class="pull-right">
                      <a href="logout.php" class="btn btn-default btn-flat">Déconnecter</a>
                    </div>
                  </li>
                </ul>
              </li>
      
              
            </ul>
          </div>
        </nav>
      </header>

      <aside class="main-sidebar">

        <section class="sidebar">

          <div class="user-panel">
            <div class="pull-left image">
              <img src="profil_photo/<?php echo $participant->photo();?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($participant->prenom());?></p>
    
              <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li><a href="participant.php"><i class="fa fa-linkedin-square"></i> <span>Tableau de bord</span></a></li>
            <li class=" treeview"><a href=""><i class="fa fa-linkedin-square"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="participant_information.php">Informations personnelles</a></li>
                <li><a href="participant_photo.php">Photo</a></li>
              </ul>
            </li>
            <li class=" treeview"><a href=""><i class="fa fa-linkedin-square"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="participant_mot_passe.php">Mot de passe</a></li>
                <li><a href="participant_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li class="active"><a href="participant_reservation.php"><i class="fa fa-linkedin-square"></i> <span>Vos réservations</span></a></li>
            <li><a href="recherche_covoiturage_participant.php"><i class="fa fa-linkedin-square"></i> <span>Rechercher covoiturage</span></a></li>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">
 
        <section class="content-header">
          <h1>
            Réservations

          </h1>
        </section>
        <!-- section si une réservation est supprimé affiche un message que la réservation est supprimé -->
        <?php if(isset($_SESSION['supp_reserv']) && $_SESSION['supp_reserv']==1){$_SESSION['supp_reserv']=""; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#605ca8;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre réservation est supprimée !!</div>';}
		?>

        <section class="content">
        <!-- affichage la liste des réservations du participant -->
        <?php if(count($reservation)>0)
	{
   echo'    
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Num_trajet</th>
        <th>Type</th>
        <th>Ville depart</th>
        <th>Ville destination</th>
        <th>Date aller</th>
        <th>Heure aller</th>
        <th>Prix</th>
        <th>Désister</th>
        <th>ID_conducteur</th>
        <th>Consulter_trajet</th>
      </tr>
    </thead>
    <tbody>';
?>
    <?php
	 
foreach ($reservation as $reserv)
{
echo '<tr>' ;
echo '<td>',$reserv->num_trajet(),'</td>';
echo '<td>';if($reserv->type()=="A"){echo 'Aller';}else{echo 'Aller-Retour';}echo '</td>';
echo '<td>',utf8_encode($managerville->getn($reserv->num_ville1())),'</td>';
echo '<td>',utf8_encode($managerville->getn($reserv->num_ville2())),'</td>';
echo '<td>',$reserv->date_aller(),'</td>';
echo '<td>',$reserv->heure_aller(),'</td>';
echo '<td>',$reserv->prix(),'</td>';
echo '<td style="text-align:center;">';if(date("Y-m-d")>$reserv->date_aller()){echo '';} else {echo'<i  class="fa fa-remove" onclick="showDialog'.$reserv->num_trajet().'()" style="cursor:pointer;color:#ffc4c4;"></i>';}echo'</td>';
echo '<td>',$reserv->id_conducteur(),'</td>';
echo '<td style="text-align:center;"><i onClick="show'.$reserv->num_trajet().'()" style="color:blue;cursor:pointer;text-align:center;" class="fa fa-forward"></i></td>
<script>
function show'.$reserv->num_trajet().'(){
	document.getElementById("annonce_affich'.$reserv->num_trajet().'").style.display= "block";
	document.getElementById("ann_aff_content'.$reserv->num_trajet().'").style.display= "block";
}
</script>';
echo '</tr>';

}

?>
    </tbody>
  </table>
  
  <?php 
  // affichage des messages de confirmation si le participant veut supprimer une réservation
foreach($reservation as $reserv)
{echo'
	   <div id="white-background'.$reserv->num_trajet().'">
</div>
<div id="dlgbox'.$reserv->num_trajet().'">
    <div id="dlg-header">Confirmation</div>
    <div id="dlg-body">Vous voulez vraiment supprimer cette réservation ?</div>
    <div id="dlg-footer" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="participant_reservation.php" style=" margin-left:280px;">
	<input type="text" hidden="true" value="'.$reserv->num_trajet().'" name="ville'.$reserv->num_trajet().'">
        <button type="submit" style="width:50px;" name="bouton_supp'.$reserv->num_trajet().'" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHide'.$reserv->num_trajet().'()">Annuler</button>
    </div>
</div>
	
<style>
        #white-background'.$reserv->num_trajet().'{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.7;
            z-index: 9999;
        }

        #dlgbox'.$reserv->num_trajet().'{
            /*initially dialog box is hidden*/
            display: none;
            position: fixed;
            width: 480px;
            z-index: 9999;
            border-radius: 10px;
            background-color: #7c7d7e;
        }

        #dlg-header{
            background-color: #6d84b4;
            color: white;
            font-size: 20px;
            padding: 10px;
            margin: 10px 10px 0 10px;
        }

        #dlg-body{
            background-color: white;
            color: black;
            font-size: 14px;
            padding: 10px;
            margin: 0 10px 0 10px;
        }

        #dlg-footer{
            background-color: #f2f2f2;
            text-align: right;
            padding: 10px;
			
            margin: 0 10px 10px 10px;
        }

        #dlg-footer button{
            background-color: #6d84b4;
            color: white;
            padding: 5px;
			width:80px;
			border-radius:5px;
            border: 0;
        }
    </style>
	<script>
	function dlgHide'.$reserv->num_trajet().'(){
        var whitebg = document.getElementById("white-background'.$reserv->num_trajet().'");
        var dlg = document.getElementById("dlgbox'.$reserv->num_trajet().'");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }
	function showDialog'.$reserv->num_trajet().'(){
        var whitebg = document.getElementById("white-background'.$reserv->num_trajet().'");
        var dlg = document.getElementById("dlgbox'.$reserv->num_trajet().'");
        whitebg.style.display = "block";
        dlg.style.display = "block";

        var winWidth = window.innerWidth;

        dlg.style.left = (winWidth/2) - 480/2 + "px";
        dlg.style.top = "150px";
    }
	</script>';}}
	else
	{echo '<div style="text-align:center;margin-top:20px;font-size:18px;">Aucune Réservations</div>';
	}
	
	
?> 
<!-- affichage les détails des réservations de  -->
<?php 
if(count($reservation)>0)
{
foreach ($reservation as $traj)
{
echo
'<style>
#annonce_affich'.$traj->num_trajet().' {
display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.9;
            z-index: 9999;
}
#ann_aff_content'.$traj->num_trajet().'{
            display: none;
            position: fixed;
            width: 65%;
			font-size:16px;
			color:white;
			padding:10px 15px 15px 15px;
			left:200px;
			opacity:1;
			top:10px;
			background-size:cover;
			background-image:url(images/connexion.png);
            z-index: 9999;
            border-radius: 10px;

}
#ann_aff_content'.$traj->num_trajet().' input[type="submit"]{
width:100%;padding:15px 15px 15px 15px;border-radius:5px;border:#fa6c65;
                    margin-top:10px;color:white;
                                                   background-color:#ba5a75;}
#img_close'.$traj->num_trajet().'
{position:absolute;
left:-15px;
top:-10px;
cursor:pointer;
}
</style>';
}
?>


    <?php 
	foreach ($reservation as $traj)
	{
		$cond=$managerc->get($traj->id_conducteur());
$age=age($cond->date_naissance());
$voiture= $managervo->getlist($cond->id());
$commentaires=$managerco->getlist($traj->num_trajet());
	echo 
'<div id="annonce_affich'.$traj->num_trajet().'">
	<div id="ann_aff_content'.$traj->num_trajet().'">
	<img id="img_close'.$traj->num_trajet().'" style="cursor:pointer;" src="images/close-button.png" width="30px" height="30px" 
onClick="hide'.$traj->num_trajet().'()"/>
	<script>
	function hide'.$traj->num_trajet().'(){
	document.getElementById("annonce_affich'.$traj->num_trajet().'").style.display= "none";
	document.getElementById("swiper").style.display= "block";

	}
	</script>
		<div style=" display: -webkit-flex;
    display: flex;border:1px solid;width:97%;border-radius:5px;padding-left:350px;margin-bottom:10px;">
    
<h1 style="margin-right:10px;text-align:center;">'.utf8_encode($managerville->getn($traj->num_ville1())).' </h1>
<img src="images/forward.png" width="80px" height="50px" style="margin-top:10px;"/>
<h1 style="margin-left:10px;">'.utf8_encode($managerville->getn($traj->num_ville2())).'</h1>
		</div>
		<div style=" display: -webkit-flex;
    display: flex;">
   
			<div id="information" 
			style="padding-left:30px; border:1px solid;border-radius:5px;padding-right:50px;padding-top:15px;width:54%;">
					<p style="color:white;">Départ 
					<img src="images/cercle_vert.png" width="20px" height="20px" style="margin-left:150px;margin-right:15px;position:relative;top:3px;"/>
					'.utf8_encode($managerville->getn($traj->num_ville1())).'</p>

					<p style="color:white;">Arrivée 
					<img src="images/cercle_rouge.png" width="20px" height="20px" style="margin-left:150px;margin-right:15px;position:relative;top:3px;"/>
					'.utf8_encode($managerville->getn($traj->num_ville2())).'</p>

					<p style="color:white;">Date de départ 
					<img src="images/Calendar_Grey__white.png" width="20px" height="20px" style=" margin-left:95px;margin-right:15px;position:relative;top:3px;"/>
					'.$traj->date_aller().' à '.$traj->heure_aller().'</p>
					';if($traj->type()=="R"){ echo '
					<p style="color:white;">Date de retour 
					<img src="images/Calendar_Grey__white.png" width="20px" height="20px" style=" margin-left:95px;margin-right:15px;position:relative;top:3px;"/>
					'.$traj->date_retour().' à '.$traj->heure_retour().'</p>';} echo '
					<p style="color:white;">Détails </p>
                    <div style=" display: -webkit-flex;
    display: flex;background-color:#33CCCC;border-radius:5px;padding-left:15px;width:100%;">
                      <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="40px" height="40px"/>
                    <p style="color:white; margin-left:10px;margin-top:7px;">
					<strong>'.ucfirst($cond->prenom()).'</strong><br>';
					if($traj->description()==""){ echo'
                    Le conducteur n&acute;a pas donné plus de détails sur son trajet.';}
					else { echo utf8_encode($traj->description());}echo '</p>
                    </div>
			<div style="margin-top:20px;">
			<span style="margin-top:20px;">Commentaires</span><br>
			</div>'; 
			if(count($commentaires)>0) 
				{foreach ($commentaires as $comm) 
				{if ($comm->id_participant()!='') 
				{$part=$managerp->get($comm->id_participant()); echo ' 
			
					<div style="display: -webkit-flex;
    display: flex;">
					 <img id="profil"src="profil_photo/'.$part->photo().'" style="border-radius:100%;
					 margin-right:20px;margin-top:30px;" width="40px" height="40px"/>
					<div>
					<div style="margin-top:10px;margin-bottom:-10px;margin-left:30px;">
					<strong style="margin-right:5px;">'.ucfirst($part->prenom()).'</strong><small> '.$comm->date_comm().'</small>
					</div>
					<div class="dialogbox">
    <div class="body">
      <span class="tip tip-left"></span>
      <div class="message">
        <span>'.utf8_encode($comm->contenu()).'</span>
      </div>
    </div>
  </div>
  </div>
  ';if(($part->id()==$participant->id()) && ($part->nom()==$participant->nom()) && ($part->prenom()==$participant->prenom()) && 
  ($part->email()==$participant->email())){echo ' 
  <i class="fa fa-remove" onClick="showsupp'.$comm->id_commentaire().'()" style="color:pink;margin-top:55px;cursor:pointer; margin-left:10px;"></i>';} echo'
  </div>
  <div id="white-backgroundc'.$comm->id_commentaire().'">
</div>
<div id="dlgboxc'.$comm->id_commentaire().'">
    <div id="dlg-header">Confirmation</div>
    <div id="dlg-bodyc">Vous voulez vraiment supprimer ce commentaire ?</div>
    <div id="dlg-footerc" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="participant_reservation.php" style=" margin-left:280px;">
	<input type="text" hidden="true" name="comm'.$comm->id_commentaire().'" id="comm'.$comm->id_commentaire().'">
	';$_SESSION['id_comm']=1; echo'
        <button type="submit" style="width:50px;" name="bouton_supp_comm'.$comm->id_commentaire().'" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHidec'.$comm->id_commentaire().'()">Annuler</button>
    </div>
</div>
	
<style>
        #white-backgroundc'.$comm->id_commentaire().'{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.7;
            z-index: 9999;
        }

        #dlgboxc'.$comm->id_commentaire().'{
            /*initially dialog box is hidden*/
            display: none;
            position: fixed;
            width: 480px;
            z-index: 9999;
            border-radius: 10px;
            background-color: #7c7d7e;
        }

        #dlg-headerc{
            background-color: #6d84b4;
            color: white;
            font-size: 20px;
            padding: 10px;
            margin: 10px 10px 0 10px;
        }

        #dlg-bodyc{
            background-color: white;
            color: black;
            font-size: 14px;
            padding: 10px;
            margin: 0 10px 0 10px;
        }

        #dlg-footerc{
            background-color: #f2f2f2;
            text-align: right;
            padding: 10px;
			
            margin: 0 10px 10px 10px;
        }

        #dlg-footerc button{
            background-color: #6d84b4;
            color: white;
            padding: 5px;
			width:80px;
			border-radius:5px;
            border: 0;
        }
    </style>
	<script>
	function dlgHidec'.$comm->id_commentaire().'(){
        var whitebgc = document.getElementById("white-backgroundc'.$comm->id_commentaire().'");
        var dlgc = document.getElementById("dlgboxc'.$comm->id_commentaire().'");
		
        whitebgc.style.display = "none";
        dlgc.style.display = "none";
    }
	function showsupp'.$comm->id_commentaire().'(){
        var whitebgc = document.getElementById("white-backgroundc'.$comm->id_commentaire().'");
        var dlgc = document.getElementById("dlgboxc'.$comm->id_commentaire().'");
        whitebgc.style.display = "block";
        dlgc.style.display = "block";

        var winWidth = window.innerWidth;

        dlgc.style.left = (winWidth/2) - 480/2 + "px";
        dlgc.style.top = "150px";
    }
	</script>';
  
  
  }
  elseif ($comm->id_conducteur()!='') 
				{$conduu=$managerc->get($comm->id_conducteur()); echo ' 
			
					<div style="display: -webkit-flex;
    display: flex;">
					 <img id="profil"src="profil_photo/'.$conduu->photo().'" style="border-radius:100%;
					 margin-right:20px;margin-top:30px;" width="40px" height="40px"/>
					<div>
					<div style="margin-top:10px;margin-bottom:-10px;margin-left:30px;">
					<strong style="margin-right:5px;">'.ucfirst($conduu->prenom()).'</strong><small> '.$comm->date_comm().'</small>
					</div>
					<div class="dialogbox">
    <div class="body">
      <span class="tip tip-left"></span>
      <div class="message">
        <span>'.utf8_encode($comm->contenu()).'</span>
      </div>
    </div>
  </div>
  </div></div>';}}}
  else
  { echo 'Aucun commentaire';} 
  echo'
  <div style="margin-bottom:40px;">
  <form method="post" action="participant_reservation.php?num='.$traj->num_trajet().'">
  <label for="comment"></label><br>
<textarea name="contenu" style="border-radius:5px;padding:5px 10px 5px 15px;" placeholder="Tapez votre commentaire" class="form-control" rows="3" cols="70" id="comment"></textarea><br>

      
	  <input type="submit" name="bouton_commentaire" value="Laisser un commentaire" style="width:50%;">
  
  </form>
  </div>
					
					

			</div>
			<style>
			.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}



.tip-left {
  top: 10px;
  left: -25px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}


.dialogbox .body {
  position: relative;
  width: 300px;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #DADADA;
  border-radius: 3px;
  border: 5px solid #ccc;
}

.body .message {
  min-height: 30px;
  border-radius: 3px;
  font-family: Arial;
  font-size: 14px;
  line-height: 1.5;
  color: #797979;
}
			</style>
			<div style="margin-left:30px;">
               <div style="border:1px solid;border-top:4px solid #58b20d; border-radius:5px;">
					<div style=" display: -webkit-flex;
    display: flex;width:100%;border-bottom:1px solid;">
							<div style="padding:10px 40px 10px 40px;text-align:center;">
                           <span style="font-size:23px;font-weight:bolder;color:#58B20D; font-family:pacifico;">
						    <span style="margin-right:3px;font-size:30px;">'.$traj->prix().'</span> DZD</span><br>

                           <small>par place</small>
                            </div>
                            <div style="padding:10px 40px 10px 40px;text-align:center;border-left:1px solid;">';
                             if($traj->nombre_place()==0)
							{echo '<br><span style="font-size:30px;font-weight:bolder; color:red;font-family:pacifico;">Complet</span><br>
							 </div>
                            </div>
                            <div style="padding:10px;">
					<form method="post" action="reservation.php?id_participant='.$participant->id().'&num_trajet='.$traj->num_trajet().'" >
                    
					<select style="width:100%;padding:10px 15px 10px 15px;border-radius:5px;cursor:not-allowed"  disabled/>
                    <option checked>0 place</option>
                    </select><br>

                    <input type="submit" id="submit" style="width:91%;cursor:not-allowed;" onclick="showDialog'.$traj->num_trajet().'()" value="Réserver" disabled/>
                    </form>';}
							else {echo '<span style="font-size:30px;font-weight:bolder; color:white;font-family:pacifico;">'.$traj->nombre_place().'</span><br>
							<small>places restantes</small>
							 </div>
                            </div>
                            <div style="padding:10px;">
					<form method="post" action="reservation.php?id_participant='.$participant->id().'&num_trajet='.$traj->num_trajet().'" >
                    <select style="width:100%;padding:10px 15px 10px 15px;border-radius:5px;cursor:not-allowed;color:black;" id="place'.$traj->num_trajet().'" disabled />
					';for($i=1;$i<=$traj->nombre_place();$i++)
					{if($i==1)
					{echo '<option value="1" checked>1 place</option>';}
					else{
					echo '<option value="'.$i.'">'.$i.' places</option>';}}
					echo'
                    </select><br>

                    <input type="submit" id="submit" style="width:91%;cursor:not-allowed;" onclick="showDialog'.$traj->num_trajet().'()" value="Réserver" disabled/>
                    </form>';}echo '
                    </div>
					</div>
	  
	   <div id="white-background'.$traj->num_trajet().'">
</div>
<div id="dlgbox'.$traj->num_trajet().'">
    <div id="dlg-header">Confirmation</div>
    <div id="dlg-body">Vous voulez vraiment réserver ?</div>
    <div id="dlg-footer" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="reservation.php?id_participant='.$participant->id().'&num_trajet='.$traj->num_trajet().'"" style=" margin-left:280px;">
	<select hidden="true" name="places'.$traj->num_trajet().'" id="places'.$traj->num_trajet().'">
	
                    
                    </select>
	
        <button type="submit" style="width:50px;" name="bouton_reservation" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHide'.$traj->num_trajet().'()">Annuler</button>
    </div>
</div>
	
<style>
        #white-background'.$traj->num_trajet().'{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.7;
            z-index: 9999;
        }

        #dlgbox'.$traj->num_trajet().'{
            /*initially dialog box is hidden*/
            display: none;
            position: fixed;
            width: 480px;
            z-index: 9999;
            border-radius: 10px;
            background-color: #7c7d7e;
        }

        #dlg-header{
            background-color: #6d84b4;
            color: white;
            font-size: 20px;
            padding: 10px;
            margin: 10px 10px 0 10px;
        }

        #dlg-body{
            background-color: white;
            color: black;
            font-size: 14px;
            padding: 10px;
            margin: 0 10px 0 10px;
        }

        #dlg-footer{
            background-color: #f2f2f2;
            text-align: right;
            padding: 10px;
			
            margin: 0 10px 10px 10px;
        }

        #dlg-footer button{
            background-color: #6d84b4;
            color: white;
            padding: 5px;
			width:80px;
			border-radius:5px;
            border: 0;
        }
    </style>
	<script>
	function dlgHide'.$traj->num_trajet().'(){
        var whitebg = document.getElementById("white-background'.$traj->num_trajet().'");
        var dlg = document.getElementById("dlgbox'.$traj->num_trajet().'");
		
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }
	function showDialog'.$traj->num_trajet().'(){
        var whitebg = document.getElementById("white-background'.$traj->num_trajet().'");
        var dlg = document.getElementById("dlgbox'.$traj->num_trajet().'");
        whitebg.style.display = "block";
        dlg.style.display = "block";
		 var x = document.getElementById("places'.$traj->num_trajet().'");
 var z = document.getElementById("place'.$traj->num_trajet().'");
    var option = document.createElement("option");
    option.text = z.value;
option.value=z.value;
y=x.length;
for (i=0;i<x.length;i++)
{
        x.remove(x.length-1);}
    x.add(option);

        var winWidth = window.innerWidth;

        dlg.style.left = (winWidth/2) - 480/2 + "px";
        dlg.style.top = "150px";
    }
	</script>
					<div style="margin-top:10px;border:1px solid;border-radius:5px;">
							<div style="border-bottom:1px solid white;padding:10px 15px 10px 15px;background-color:gray;color:white;">
                            Conducteur
                            </div>
                            <div style="padding:15px;">
                            <div style=" display: -webkit-flex;
    display: flex;border-bottom:1px solid;padding-bottom:7.5px;margin-bottom:7.5px">
                            <a style="cursor:pointer;" href="profil_conducteur.php?id='.$cond->id().'"><img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="70px" height="70px"/></a>
                            <div style="margin-left:20px;margin-top:10px;">
                            <strong>'.ucfirst($cond->prenom()).'</strong><br>
                            '.$age.' ans 
                            </div>
                            </div>
                            <div style="padding-top:5px;">
                            <strong>Véhicule</strong> <br>
							'.$voiture[0]->marque().'<br>
                            Couleur : '.$voiture[0]->couleur().'
                            </div>
                            </div>
					</div>

			</div>
		</div>
	</div>
</div>';
}
}
	?>
        </section>
      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs">
          EtuCovoiturage
        </div>
        <strong>Covoiturage,2016 &copy;</strong> 
      </footer>

    </div>
    <script src="js/jQuery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
        <script src="js/app.min.js"></script>
  </body>
</html>
