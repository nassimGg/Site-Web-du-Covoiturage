<?php 
session_start();
require_once ('dbconfig.php');
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
$villemanager=new VilleManager();
$villes=$villemanager->villelist();

if($manager->is_loggedin()||$manager2->is_loggedin())
{$manager->redirect('publication_non_autorise.php');
}
elseif (!$manager1->is_loggedin()&& !$manager->is_loggedin()&& !$manager2->is_loggedin())
{session_start();
	$_SESSION['annonce']=1;

	
	$manager1->redirect('login.php');
}
else
{$id_conducteur=$_SESSION['user_cond'];
$heure_retour="";$error="";
	$cond=$manager1->get($id_conducteur);
	if(isset($_POST['bouton_publier']))
	{	if($_POST['frequence']=="R")
		{
			$heure_retour=$_POST['heure2']."h".$_POST['minute_2'];
			if($_POST['date_retour']=="")
			{
				$error="Vérifier la date de retour !!";
			}
			elseif($_POST['heure2']=="" || $_POST['minute_2']=="")
			{
				$error="Vérifier l&acute;heure de retour !!";
			}
		}
		if($error=="")
		{
		$heure_aller=$_POST['heure1']."h".$_POST['minute_1'];
		
		$type=$_POST['frequence'];
		$details=$_POST['details'];
		
		$managertrajet=new TrajetManager();
		$numville1=$villemanager->get(utf8_decode($_POST['depart']));
		$numville2=$villemanager->get(utf8_decode($_POST['dest']));
		$trajet=new Trajet(array('type'=>$type,'num_ville1'=>$numville1,
		'num_ville2'=>$numville2,'date_aller'=>$_POST['date_aller'],'date_retour'=>$_POST['date_retour'],
		'heure_aller'=>$heure_aller,'heure_retour'=>$heure_retour,'id_conducteur'=>$id_conducteur,'prix'=>$_POST['prix'],'nombre_place'=>$_POST['place'],
		'description'=>$details));
		if($managertrajet->addtrajet($trajet))
		{
			$manager1->redirect('publication_reussie.php');
		}
	}
	}
}




?>



<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">

<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/style2.css" />
<link rel="stylesheet" href="css/swiper.min.css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<title>Publication | ETU Covoiturage</title>
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

<div id="bloc_page">
<header id="header">
  <div id="titre_principal"> <a href="index_profil_conducteur.php">
    <div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
    <h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
    </a> </div>
<nav>
<ul id="navigation1">
<li ><a style="cursor:pointer"href="logout.php"><span id="main">Déconnecter</span></a></li>
<li id="profilc"><a id="profilb" href="#"style="padding:5px;border-radius:5px;cursor:pointer;width:50%"><img src="images/passenger-male-18.png" width="18px" height="18px" style="border-radius:100%;margin-right:3px;padding-top:px;display:inline-block;top:3px;position:relative;"/><span id="main"> <?php echo ucfirst($cond->prenom())?></span> <i id="carret"></i></a>
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
</nav>	   
<br>

</header>
<section>
<h1 style="margin-left:110px;font-size:28px;">Publier une annonce</h1>
<div id="error" style="margin-top:50px;">
        <?php
		
			if($error!="")
			{
				?>
                <div class="alert" style="background:url(images/attention1.png);background-size:40px 40px;
                   background-repeat:no-repeat; background-position:10px 5px;
                   font-weight:800;
                   background-color:#ffbaba;width:50%;
                   border:2px solid #ff8787;
                   border-radius:5px;
                   height:20px;margin-left:250px;padding:15px 10px 15px 60px;margin-bottom:60px;">
                   <span > 
                   &nbsp; <?php echo $error; ?> !</span>
                </div>
                <?php
			}
		?>
        </div>
<div>
		<form method="post" >
       <div id="form_annonce">
        <div id="super_box" style="margin-left:110px;">
        <div style="border:1px solid #BBBBBB;width:100%;background-color:#e3e3cf;border-radius:5px;padding-right:10px;">
        <legend style="padding-top:5px;border-bottom:1px solid #BBBBBB;width:97.7%;height:30px;padding-left:20px;background-color:#fafafa;font-size:20px;font-weight:bold;border-radius:5px 5px 0px 0px;padding-bottom:10px;">Fréquence</legend>
      
        <input type="radio" name="frequence" onClick="retour_hide()" checked value="A" 
        style="display:inline;
margin-left:20px;
padding-right:30px;
margin-top:20px;
margin-bottom:20px;
	padding: 8px;
     "/>
        Je fais ce trajet juste pour aller

        <input type="radio" value="R" onClick="retour_show()" name="frequence" 
        style="margin-left:50px;padding-right:30px;"/><span style="word-wrap: break-word;width:10em;" >Je fais ce trajet Aller-Retour</span>

        </div>
        <div style="margin-top:30px;border:1px solid #BBBBBB;width:100%;padding-right:10px;border-radius:5px;height:auto;background-color:#e3e3cf;color:black;">
        <legend style="padding-top:5px;border-bottom:1px solid #BBBBBB;background-color:#fafafa;font-size:20px;font-weight:bold;;width:97.7%;height:30px;padding-left:20px;margin-bottom:17px;border-radius:5px 5px 0px 0px;padding-bottom:10px;">Itinéraire</legend>
        <label for="ville_depart" style="color:black;padding-top:20px;padding-left:20px;">Point de départ</label><br>
<input id="v"list="villes" required name="depart" placeholder="De" style="background-image: url(images/cercle_vert.png); height: 25px; background-size: 15px 20px; background-position: 5px 5px; border: 2px solid #ccc;
 border-radius: 5px; font-size: 16px; color: black; padding-top: 5px; padding-bottom: 5px;width:70%; padding-left: 30px;margin-left:20px;margin-top:7px; background-repeat: no-repeat;margin-bottom:20px;">
<datalist id="villes">
<?php 
foreach ($villes as $ville)
{$vill = utf8_encode($ville->nom_ville()); 
echo '<option value="',$vill,'">';
}

?>
  </datalist><br>
<label for="ville_dest" style="color:black;padding-top:20px;padding-left:20px;">Point d'arrivée</label><br>
<input id="ve" required name="dest" type="text" placeholder="Á" style=" 
  background-size:15px 20px;
  margin-left:20px;margin-top:7px; 
  background-image:url(images/cercle_rouge.png);
  height:25px;
  width:70%;
  margin-bottom:50px;
  background-position:5px 5px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
   color:black;
    padding-top:5px;
    padding-bottom:5px;
    padding-left:30px;
    background-repeat: no-repeat;" list="villes"autocomplete="on">
<datalist id="villes">
<?php 
foreach ($villes as $villee)
{$vill = utf8_encode($ville->nom_ville()); 
echo '<option value="', $vill,'">';
}
?>
  </datalist>
</div>

<div style="margin-top:30px;border:1px solid #BBBBBB;width:100%;padding-right:10px;border-radius:5px;height:auto;background-color:#e3e3cf;padding_bottom:20px;">
<legend style="padding-bottom:10px;padding-top:5px;background-color:#fafafa;font-size:20px;font-weight:bold;border-bottom:1px solid #BBBBBB;width:97.7%;height:30px;padding-left:20px;margin-bottom:17px;border-radius:5px 5px 0px 0px;">Date et Horaire</legend>
<span style="margin-left:20px">Aller :<br>
</span>
<input type="text" required name="date_aller"id="Datepicker2" placeholder="MM/JJ/AAAA" style=" background-image:url(images/calandaricon.png);
  background-size:20px 20px;
  width:35%;
  box-sizing: border-box;
  height:32px;
  margin-top:7px;
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left:20px;
    background-color: white;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:40px;
    margin-bottom:20px;
    background-repeat: no-repeat;">
<select required name="heure1" style="
  width:8.5%;
  box-sizing: border-box;
  height:32px;
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left:5px;
    background-color: white;
    ">
<option></option>
<option value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
</select> h
<select name="minute_1" required style="
  width:8.5%;
  box-sizing: border-box;
  height:32px;
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left:5px;
    background-color: white;
    ">
<option></option>
<option value="0">00</option>
<option value="10">10</option>
<option value="20">20</option>
<option value="30">30</option>
<option value="40">40</option>
<option value="50">50</option>
</select><br>
<div id="time_retour" hidden="true">
<span style="margin-left:20px">Retour :<br>
</span>
<input type="text" name="date_retour" id="Datepicker3"   placeholder="AAAA/MM/JJ" style=" background-image:url(images/calandaricon.png);
  background-size:20px 20px;
  width:35%;
  box-sizing: border-box;
  height:32px;
  margin-top:7px;
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left:20px;
    background-color: white;
    padding-top:10px;
    margin-bottom:20px;
    padding-bottom:10px;
    padding-left:40px;
    background-repeat: no-repeat;">
<select  name="heure2" style="
  width:8.5%;
  box-sizing: border-box;
  height:32px;
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left:5px;
    background-color: white;
    ">
<option></option>
<option value="0">00</option>
<option value="1">01</option>
<option value="2">02</option>
<option value="3">03</option>
<option value="4">04</option>
<option value="5">05</option>
<option value="6">06</option>
<option value="7">07</option>
<option value="8">08</option>
<option value="9">09</option>
<option value="10">10</option>
<option value="11">11</option>
<option value="12">12</option>
<option value="13">13</option>
<option value="14">14</option>
<option value="15">15</option>
<option value="16">16</option>
<option value="17">17</option>
<option value="18">18</option>
<option value="19">19</option>
<option value="20">20</option>
<option value="21">21</option>
<option value="22">22</option>
<option value="23">23</option>
</select> h
<select  name="minute_2" style="
  width:8.5%;
  box-sizing: border-box;
  height:32px;
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
    margin-left:5px;
    background-color: white;
    ">
<option></option>
<option value="0">00</option>
<option value="10">10</option>
<option value="20">20</option>
<option value="30">30</option>
<option value="40">40</option>
<option value="50">50</option>
</select><br>
</div>
</div>
</div>
<div id="super_box" style="margin-left:100px;margin-top:-30px;">
<div style="margin-top:30px;border:1px solid #BBBBBB;width:102%;
margin-bottom:30px;border-radius:5px;height:auto;padding-bottom:20px;
background-color:#e3e3cf;padding-right:10px;">
<legend style="padding-bottom:10px;padding-top:5px;background-color:#fafafa;font-size:20px;font-weight:bold;border-bottom:1px solid #BBBBBB;width:97.2%;height:30px;padding-left:20px;margin-bottom:15px;border-radius:5px 5px 0px 0px;">Participation demandée par passager</legend>
<label style="margin-left:20px; padding-bottom:30px;color:black;">Prix de voyage 
<input required name="prix"style="margin-left:205px;width:70px; box-sizing: border-box;
  height:32px;
text-align:right;
padding-right:10px;
    border: 2px solid #ccc;
    border-left:1px thin #ccc;
    border-radius: 5px 0px 0px 5px;
    font-size: 16px;
    background-color: white;
    "type="text" value="100" ><input type="text" style="width:50px; box-sizing: border-box;
  height:32px;
text-align:center;
padding:5px;
    border: 2px solid #ccc;
    border-left:1px thin #ccc;
    border-radius: 0px 5px 5px 0px;
    font-size: 16px;
    background-color: white;"value="DZD" disabled>
</label>
</div>
<div style="margin-top:30px;border:1px solid #BBBBBB;width:98%;
background-color:#e3e3cf;padding-right:10px;
margin-bottom:30px;border-radius:5px;height:auto;padding-left:20px;padding-top:15px;padding-bottom:20px;font-size:20px;font-weight:bold;">Nombre de places proposées :
<input required name="place" type="number" style="margin-left:90px;text-align:right;
width:60px; 
box-sizing: border-box;
  height:32px;
padding:5px;
    border: 2px solid #ccc;
    border-left:1px thin #ccc;
    border-radius:5px;
    font-size: 16px;
    background-color: white;"max="5" min="1" value="3">
</div>

<div style="margin-top:30px;border:2px solid #BBBBBB;width:100%;
margin-bottom:30px;border-radius:5px;height:auto;padding-left:20px;padding-top:15px;padding-bottom:20px;background-color:#fafafa;">
<span style="font-size:20px;font-weight:bold;">Votre itinéraire</span><br><br>
<img src="images/mapalg.PNG" width="450px" height="400px" style="border:1px solid #BBBBBB;border-radius:5px;"/>
</div>
</div>
</div>
<div  style="margin-top:30px;border:1px solid #BBBBBB;width:43.5%;margin-left:110px;background-color:#e3e3cf;
margin-bottom:30px;border-radius:5px;height:auto;margin-top:-70px;padding-top:10px;padding-bottom:20px;">
<legend style="padding-bottom:10px;background-color:#fafafa;font-size:20px;font-weight:bold;border-bottom:1px solid #BBBBBB;width:96.2%;height:30px;padding-left:20px;margin-bottom:15px;border-radius:5px 5px 0px 0px;padding-top:5px;margin-top:-10px;">Détails de voyage</legend>
<p style="padding-left:20px;">Veuillez ajouter plus de détails sur votre trajet. Cela vous évitera beaucoup de questions de vos passagers.</p>
<textarea rows="7" name="details" cols="70" style="margin-left:20px;border-radius:3px;"placeholder="Exemple : “Je vais rendre visite à ma famille à Alger, je partirai de l'auto route l'est et ouest à 10h. Il y a de la place pour une petite valise par personne et votre musique sera la bienvenue !”" >
</textarea>
</div>
<input type="submit" name="bouton_publier" value="Publier votre annonce" style="float:right;margin-top:-150px;margin-right:300px;
background: #19b7e5;
	padding: 15px 20px 15px 20px;
	border-radius: 5px;
	-webkit-border-radius: 5px;
	-moz-border-radius: 5px;
	color: #fff;
	text-shadow: 1px 1px 3px rgba(0, 0, 0, 0.12);
	font: normal 30px 'Bitter', serif;
	border: 1px solid #257C9E;
	font-size: 15px;
">
</form>
</div>
</section>
<?php
require 'footer.php';
?>
</div>
<script type="text/javascript">
$(function() {
	$( "#Datepicker2" ).datepicker({minDate:0,
		maxDate:365,
		dateFormat:"yy-mm-dd"}); 
});
$(function() {
	$( "#Datepicker3" ).datepicker({minDate:0,
		maxDate:365,
		dateFormat:"yy-mm-dd"}); 
});
</script>
</body>
</html>