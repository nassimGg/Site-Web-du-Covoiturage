<?php 
session_start();
//fonction calcule l'age
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
//appel les classes
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
require_once ('Commentairemanager.class.php');
require_once ('Commentaire.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
require_once ('Reservation.class.php');
//instanciation des classes
$managerc=new ConducteurManager();
$reservation=new Reservation();
$managerville=new VilleManager();
$managerv=new VoitureManager();
$manager=new TrajetManager();
$managerp=new ParticipantManager();
$managerco=new CommentaireManager();
//recuperer la liste des trajets
$trajets=$manager->getlist();

?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Trajets | EtuCovoiturage</title>

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


  </head>


  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
<!-- tête principal -->
      <header class="main-header">

<!-- Logo -->
        <a href="admin.php" class="logo">
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
                  
                  <img src="images/leadership-avatar-m-560x450.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Administrateur</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="images/leadership-avatar-m-560x450.jpg" class="img-circle" alt="User Image">
                    <p>
                      Administrateur
                      
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="admin_email.php" class="btn btn-default btn-flat">Profil</a>
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
              <img src="images/leadership-avatar-m-560x450.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p>Administrateur</p>
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">

            <li class=" treeview"><a href="#"><i class="fa fa-link"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="admin_email.php">E-mail</a></li>
                <li><a href="admin_mot_passe.php">Mot de passe</a></li>
              </ul>
            </li>
            <li><a href="admin_villes.php"><i class="fa fa-link"></i> <span>Villes</span></a></li>
            <li>
              <a href="admin_participants.php"><i class="fa fa-link"></i> <span>Liste des participants</span></a>
            </li>
            <li>
              <a href="admin_conducteurs.php"><i class="fa fa-link"></i> <span>Liste des conducteurs</span></a>
            </li>
            <li class="active">
              <a href="admin_trajets.php"><i class="fa fa-link"></i> <span>Liste des trajets</span></a>
            </li>
          </ul>
        </section>

      </aside>

    
      <div class="content-wrapper">

        <section class="content-header">
          <h1>
            Liste trajets
            
          </h1>
        </section>


        <section class="content">
<!-- Tableau contient la liste de tout les trajets -->
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Num_trajet</th>
        <th>Type</th>
        <th>Ville_depart</th>
        <th>Ville_destination</th>
        <th>Date_aller</th>
        <th>Date_retour</th>
        <th>Heure_aller</th>
        <th>Heure_retour</th>
        <th>Prix</th>
        <th>ID_conducteur</th>
        <th>Consulter_trajet</th>
        <th>Participant_réserver</th>
      </tr>
    </thead>
    <tbody>
    <?php 
foreach ($trajets as $trajet)
{$parts=$reservation->getp($trajet->num_trajet());
echo '<tr>' ;
echo '<td>',$trajet->num_trajet(),'</td>';
echo '<td>';if($trajet->type()=="A"){echo 'Aller';}else{echo 'Aller-Retour';}echo '</td>';
echo '<td>',$trajet->num_ville1(),'</td>';
echo '<td>',$trajet->num_ville2(),'</td>';
echo '<td>',$trajet->date_aller(),'</td>';
echo '<td>';if($trajet->date_retour()=="0000-00-00"){echo'';}else {echo $trajet->date_retour();}echo'</td>';
echo '<td>',$trajet->heure_aller(),'</td>';
echo '<td>',$trajet->heure_retour(),'</td>';
echo '<td>',$trajet->prix(),' DZD</td>';
echo '<td>',$trajet->id_conducteur(),'</td>';
echo '<td style="text-align:center;"><i onClick="show'.$trajet->num_trajet().'()" style="color:blue;cursor:pointer;" class="fa fa-forward"></i></td>
<script>
function show'.$trajet->num_trajet().'(){
	document.getElementById("annonce_affich'.$trajet->num_trajet().'").style.display= "block";
	document.getElementById("ann_aff_content'.$trajet->num_trajet().'").style.display= "block";
}
</script>';
echo '<td>';if(count($parts)>0){foreach($parts as $part){echo '<a style="cursor:pointer;" href="profil_participant.php?id='.$part->id().'"><img src="profil_photo/'.$part->photo().'" width="40px" height="40px" class="img-circle" alt="User Image"/></a>';}}
else{echo 'Aucune réservation';}
echo '</tr>';
}
?>
    </tbody>
  </table>
  <?php 
foreach ($trajets as $traj)
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
            width: 70%;
			font-size:16px;
			color:white;
			padding:15px 15px 15px 15px;
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
	foreach ($trajets as $traj)
	{
		$cond=$managerc->get($traj->id_conducteur());
$age=age($cond->date_naissance());
$voiture= $managerv->getlist($cond->id());
$commentaires=$managerco->getlist($traj->num_trajet());
	echo 
'<div id="annonce_affich'.$traj->num_trajet().'">

	<div id="ann_aff_content'.$traj->num_trajet().'">
	<img id="img_close'.$traj->num_trajet().'" src="images/close-button.png" width="30px" height="30px" 
onClick="hide'.$traj->num_trajet().'()"/>
	<script>
	function hide'.$traj->num_trajet().'(){
	document.getElementById("annonce_affich'.$traj->num_trajet().'").style.display= "none";
document.getElementById("ann_aff_content'.$traj->num_trajet().'").style.display= "none";

	}
	</script>
		<div style=" display: -webkit-flex;
    display: flex;border:1px solid;width:100%;border-radius:5px;padding-left:350px;margin-bottom:10px;">
    
<h1 style="margin-right:10px;text-align:center;">'.utf8_encode($managerville->getn($traj->num_ville1())).' </h1>
<img src="images/forward.png" width="80px" height="50px" style="margin-top:10px;"/>
<h1 style="margin-left:10px;">'.utf8_encode($managerville->getn($traj->num_ville2())).'</h1>
		</div>
		<div style=" display: -webkit-flex;
    display: flex;">
   
			<div id="information" 
			style="padding-left:30px; border:1px solid;border-radius:5px;padding-right:50px;padding-top:15px;width:62%;">
					<p style="color:white;">Départ 
					<img src="images/cercle_vert.png" width="20px" height="20px" style="margin-left:150px;margin-right:15px;position:relative;top:3px;"/>
					'.utf8_encode($managerville->getn($traj->num_ville1())).'</p>

					<p style="color:white;">Arrivée 
					<img src="images/cercle_rouge.png" width="20px" height="20px" style="margin-left:150px;margin-right:15px;position:relative;top:3px;"/>
					'.utf8_encode($managerville->getn($traj->num_ville2())).'</p>

					<p style="color:white;">Date de départ 
					<img src="images/Calendar_Grey__white.png" width="20px" height="20px" style=" margin-left:100px;margin-right:15px;position:relative;"/>
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
  </div></div>';}
  elseif ($comm->id_conducteur()!='') 
				{$condu=$managerc->get($comm->id_conducteur()); echo ' 
			
					<div style="display: -webkit-flex;
    display: flex;">
					 <img id="profil"src="profil_photo/'.$condu->photo().'" style="border-radius:100%;
					 margin-right:20px;margin-top:30px;" width="40px" height="40px"/>
					<div>
					<div style="margin-top:10px;margin-bottom:-10px;margin-left:30px;">
					<strong style="margin-right:5px;">'.ucfirst($condu->prenom()).'</strong><small> '.$comm->date_comm().'</small>
					</div>
					<div class="dialogbox">
    <div class="body">
      <span class="tip tip-left"></span>
      <div class="message" style="font-size:18px; color:black;">
        <span>'.utf8_encode($comm->contenu()).'</span>
      </div>
    </div>
  </div>
  </div></div>';}}}
  else
  { echo 'Aucun commentaire';} 
  echo'
  <div style="margin-bottom:20px;margin-top:40px;font-size:16px;text-align:center;">
  Vous n&acute;etes pas autorisé pour laisser un commentaire
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
							{echo '<br><span style="font-size:30px;font-weight:bolder; color:red;font-family:pacifico;">Complet</span><br>';}
							else {echo '<span style="font-size:30px;font-weight:bolder; color:white;font-family:pacifico;">'.$traj->nombre_place().'</span><br>
							<small>places restantes</small>';}echo '
                            </div>
                            </div>
                            <div style="padding:10px;">
					<form>
                    <select style="width:100%;color:black;padding:10px 15px 10px 15px;border-radius:5px;cursor:not-allowed;" disabled>
                    <option>1 place</option>
                    <option>2 places</option>
                    <option>3 places</option>
                    </select><br>

                    <input type="submit" style="cursor:not-allowed;" value="Réserver" disabled/>
                    </form>
                    </div>
					</div>
					<div style="margin-top:10px;border:1px solid;border-radius:5px;">
							<div style="border-bottom:1px solid white;padding:10px 15px 10px 15px;background-color:gray;color:white;">
                            Conducteur
                            </div>
                            <div style="padding:15px;">
                            <div style=" display: -webkit-flex;
    display: flex;border-bottom:1px solid;padding-bottom:7.5px;margin-bottom:7.5px">
                            <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="70px" height="70px"/>
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
	?>
        </section>
      </div>

 
      <footer  class="main-footer">
 
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
