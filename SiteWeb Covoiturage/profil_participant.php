<?php
session_start();
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
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Reservation.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');

require_once ('Administrateurmanager.class.php');
require_once ('Administrateur.class.php');
$managerp=new ParticipantManager();
$managerc=new ConducteurManager();
$reserv=new Reservation();
$managera=new AdministrateurManager();
if(isset($_GET['id']))
{$id=$_GET['id'];
	$part=$managerp->get($id);
	$nombre=$reserv->countr($id);
}
?>
<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">

<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/style2.css" />
<link rel="stylesheet" href="css/swiper.min.css" type="text/css">
<link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<title>Profil Participant | ETU Covoiturage</title>
<link rel="icon" type="images/png" href="images/title.gif"/>
<script src="js/popup.js"></script>
<script src="js/swiper.min.js"></script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/menu_jquery.js"></script>
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
</head>
<body>
<div  style="background-color:#fffffe;width: auto;
height:contain;
margin-left: 5px;
margin-right:5px;color:black;">
<?php 
if($managerc->is_loggedin())
{$id=$_SESSION['user_cond'];
$cond=$managerc->get($id);
	echo '<header id="header">
  <div id="titre_principal"> <a href="index_profil_conducteur.php">
    <div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
    <h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
    </a> </div>
<nav>
<ul id="navigation1">
<li ><a style="cursor:pointer"href="logout.php"><span id="main">Déconnecter</span></a></li>
<li id="profilc"><a id="profilb" href="#"style="padding:5px;border-radius:5px;cursor:pointer;width:50%"><img src="images/passenger-male-18.png" width="18px" height="18px" style="border-radius:100%;margin-right:3px;padding-top:px;display:inline-block;top:3px;position:relative;"/><span id="main"> '.ucfirst($cond->prenom()).'</span> <i id="carret"></i></a>
<ul id="profilBox" style="list-style-type:none;">
		<div id="details_profil">
			<li style=""><a href="conducteur.php" style="cursor:pointer; color:inherit;">Tableau de bord</a></li>
			<li  style="height:1px;border-bottom:0.5px solid #000;width:100%;padding:0px"></li>
			<li style=""><a href="conducteur_annonce.php" style="cursor:pointer;color:inherit;">Vos annonces</a></li>
			<li ><a href="conducteur_information.php" style="cursor:pointer;color:inherit;">Profil</a></li>
			<li ><a href="logout.php" style="cursor:pointer;color:inherit;">Se déconnecter</a></li>
		</div>
</ul>
</li>
</ul>
</nav>';
}
elseif($managera->is_loggedin())
{echo '<header id="header">
  <div id="titre_principal"> <a href="admin.php">
    <div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
    <h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
    </a> </div>
<nav>
<ul id="navigation1" style="margin-left:-340px;">
<li ><a style="cursor:pointer"href="logout.php"><span id="main">Déconnecter</span></a></li>
<li id="profilc"><a id="profilb" href="#"style="padding:5px;border-radius:5px;cursor:pointer;width:50%"><img src="images/passenger-male-18.png" width="18px" height="18px" style="border-radius:100%;margin-right:3px;padding-top:px;display:inline-block;top:3px;position:relative;"/><span id="main"> Administrateur</span> <i id="carret"></i></a>
<ul id="profilBox" style="list-style-type:none;">
		<div id="details_profil">
			<li style=""><a href="admin.php" style="cursor:pointer; color:inherit;">Tableau de bord</a></li>
			<li  style="height:1px;border-bottom:0.5px solid #000;width:100%;padding:0px"></li>
			<li style=""><a href="conducteur_annonce.php" style="cursor:pointer;color:inherit;">Compte</a></li>
			<li ><a href="admin_villes.php" style="cursor:pointer;color:inherit;">Villes</a></li>
			<li ><a href="admin_participants.php" style="cursor:pointer;color:inherit;">Liste participants</a></li>
			<li ><a href="admin_conducteurs.php" style="cursor:pointer;color:inherit;">Liste conducteurs</a></li>
			<li ><a href="admin_trajets.php" style="cursor:pointer;color:inherit;">Liste trajets</a></li>
			<li ><a href="logout.php" style="cursor:pointer;color:inherit;">Se déconnecter</a></li>
		</div>
</ul>
</li>
</ul>
</nav>';
}

?>
</header>
<section id="section2" style="margin-top:40px;">
<?php 
echo '
<section class="content" style="display: -webkit-flex;
    display: flex;-webkit-flex-wrap: wrap;
    flex-wrap: wrap;margin-top:10px; 
     background-repeat:no-repeat; background-size:cover;color:black;padding:20px;border-radius:5px;">
        
        <div style="margin-right:50px;margin-left:150px;padding:15px;border:1px solid gray;border-radius:5px;width:23%;height:110px;">
        
       
        <div style="margin-bottom:8px;">
        <strong style="font-size:23px;" >Activité </strong><br>
		</div>
       <div style="margin-bottom:8px;"> <span style="margin-bottom:5px;font-size:16px;color:gray">Nombre réservations : '.$nombre.'</span></div>
       <div style="margin-bottom:10px;"> <span style="margin-bottom:5px;font-size:16px;color:gray">Date d&acute;inscription : '.$part->date_inscription().'</span></div>
        </div>
      
       
        <div>
        <div style="display: -webkit-flex;
    display: flex;padding:10px 10px 10px 15px;border-radius:5px;
    color:black;">
        <img src="profil_photo/'.$part->photo().'" width="140px" height="140px" style="border-radius:100%;" /><br>

        <div style="margin-left:50px;">
        
        <strong style="font-size:23px;">'.ucfirst($part->prenom()).' '.ucfirst(substr($part->nom(),0,1)).'</strong><br>
<small style="font-size:16px;color:gray;">('.age($part->date_naissance()).' ans)</small><br>
';if($part->tel()!=""){echo'
<small style="font-size:16px;color:black;">Numéro téléphone : '.$part->tel().'</small><br>';}echo'
        </div>
</div>
<div class="dialogbox" style="margin-top:-15px;">
    <div class="body">
      <span class="tip tip-up"></span>
      <div class="message">
        <span style="word-wrap: break-word;">';if($part->minibio()!=""){echo utf8_encode($part->minibio()); }else {echo'Je n&acute;ai pas encrore rédigé de minibio';} echo '</span>
      </div>
    </div>
  </div>
   </div>     

			<style>
			.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #e5f3ff;
}



.tip-up {
  top: -25px; /* Same as body margin top + border */
  left: 60px;
  border-right-color: transparent;
  border-left-color: transparent;
  border-top-color: transparent;
}


.dialogbox .body {
  position: relative;
  width: 500px;
  height: 30px;
  
  margin: 20px 10px;
  padding: 20px 15px 15px 10px;
  background-color:#e5f3ff;
  border-radius: 5px;
  border: 5px solid #e5f3ff;
}

.body .message {
  
  border-radius: 3px;
  font-family: Arial;
  font-size:20px;

  color: black;
}
			</style>

        
        
        </section>';
 ?>
</section>
<?php
require "footer.php";
?>
</div>
<script type="text/javascript">
$(function() {
	$( "#Datepicker1" ).datepicker(); 
});
$(function() {
	$( "#Datepicker2" ).datepicker({
		minDate:0,
		maxDate:365,
		dateFormat:"yy-mm-dd"
	}); 
});
</script>
</body>
</html>