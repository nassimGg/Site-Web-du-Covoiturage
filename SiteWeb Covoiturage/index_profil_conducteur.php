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
	require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
	require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
require_once ('Commentairemanager.class.php');
require_once ('Commentaire.class.php');
$managerville=new VilleManager();
$villes=$managerville->villelist();
$managerv=new VoitureManager();
$managert=new TrajetManager();
$managerp=new ParticipantManager();
$managerco=new CommentaireManager();
$trajets=$managert->getall();
	require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
$manager=new ConducteurManager();
$id=$_SESSION['user_cond'];
$conducteur=$manager->get($id);
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');

$managerville=new VilleManager();
$villes=$managerville->villelist();
if(isset($_POST['bouton_commentaire']))
{


	$commentaire=new Commentaire(array('contenu'=>utf8_decode($_POST['contenu']),'date_comm'=>date("Y-m-d"),'id_conducteur'=>$_SESSION['user_cond'],'num_trajet'=>$_GET['num']));
	if($managerco->add($commentaire)){
	}
}
$id=$_SESSION['user_cond'];
$managerc=new ConducteurManager();
$conducteur=$managerc->get($id);

$comment=$managerco->listc();
foreach($comment as $commen)
{
if(isset($_POST['bouton_supp_comm'.$commen->id_commentaire().'']))
{
	if($managerco->delete($commen))
	{	
	
	}

}}

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
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<title>ETU Covoiturage</title>
<link rel="icon" type="images/png" href="images/title.gif"/>
<script src="js/popup.js"></script>
  <script src="js/swiper.min.js"></script>
<script src="js/jquery-1.11.0.min.js"></script>
<script src="js/menu_jquery1.js"></script>
<script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
<script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
<script type="text/javascript" src="js/modernizr.custom.86080.js"></script>
</head>
<body>

<div id="bloc_page">
<header id="header2">
<div id="titre_principal">
<a href="index_profil_conducteur.php">
<div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
<h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
</a>
</div>
<nav>
<ul id="navigation1">
<li ><a style="cursor:pointer"href="logout.php"><span id="main">Déconnecter</span></a></li>
<li id="profilc"><a id="profilb" href="#"style="padding:5px;border-radius:5px;cursor:pointer;width:50%"><img src="profil_photo/<?php echo $conducteur->photo();?>" width="18px" height="18px" style="border-radius:100%;margin-right:3px;padding-top:px;display:inline-block;top:3px;position:relative;"/><span id="main"> <?php echo ucfirst($conducteur->prenom());?></span> <i id="carret"></i></a>
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

					   
<br><br><br><br>
   <br><br>
<div id="logo_recherche"><a href="#"><img src="images/rec.png" width="150px" height="100px" style="margin-top:-30px; margin-left:-15px;"/></a></div>
<br>
<div id="recherche">
<div id="contain_recherche2">
      <h2 style="font-size:40px; font-weight:bolder;margin-top:-30px;color:#003;">OÙ VEUX-TU ALLER ?</h2>
<h2 style="font-size:20px;color:#006;margin-top:-20px;">Tes covoiturages partout en Algerie</h2>
<form action="recherche_covoiturage_conducteur.php#section2" method="post" class="idealforms" id="form_recherche">
<div id="vil_dep"><br>
<input id="vd"list="villes" name="depart" required placeholder="Origine" style="background-image: url(images/cercle_vert.png); height: 25px; background-size: 15px 20px; background-position: 5px 5px; border: 2px solid #ccc;
 border-radius: 4px; font-size: 16px; color: black; padding-top: 5px; padding-bottom: 5px;width:100%; padding-left: 30px; background-repeat: no-repeat;">
<datalist id="villes">
<?php foreach ($villes as $villee)
{$vill = utf8_encode($villee->nom_ville()); 
echo '<option value="', $vill,'">';
}?>
  </datalist> </div>

  <div id="vil_des"><br>
<input id="vde" type="text" name="dest" required placeholder="Destination" style=" 
  background-size:15px 20px;
  background-image:url(images/cercle_rouge.png);
  height:25px;
  width:95%;
  background-position:5px 5px;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
   color:black;
margin-left:30px;
    padding-top:5px;
    padding-bottom:5px;
    padding-left:30px;
    background-repeat: no-repeat;" list="villes"autocomplete="on">
<datalist id="villes">
<?php foreach ($villes as $villee)
{$vill = utf8_encode($villee->nom_ville()); 
echo '<option value="', $vill,'">';
}?>
  </datalist>
  </div><br><br>
  <br>
  <input type="text" id="Datepicker2" name="date" required placeholder="Date départ" style=" background-image:url(images/calandaricon.png);
  background-size:25px 25px;
  width:20%;
  box-sizing: border-box;
  height:40px;
  background-position:5px 5px;
    border: 2px solid #ccc;
    border-radius: 4px;
    font-size: 16px;
    margin-left:30px;
    background-color: white;
    padding-top:10px;
    padding-bottom:10px;
    padding-left:40px;
    background-repeat: no-repeat;">
  <br><br>
<input id="da"type="submit" name="bouton_recherche" value="Rechercher">
</form>
</div>
</div>
<div id="publier_annonce"><a href="publier_annonce.php"><img src="images/publier_annonce.png" style="margin-left:40px;"/></a></div>
</header>
<section>

	<div id="annonce"><br><br>
    <div id="logo_annonce">
    <a href="#"><img src="images/annonce.png" width="150px" height="100px" /><br></a></div>
    <h3 style="font-family: myfirstfont, pacifico;
    margin: 0px;
    color: #666666;
    /* opacity: 0.6; */
    font-size: 3em;
    text-shadow: 0 1px #FFFFFF;
    text-align: center;"> Les <?php if(count($trajets)<12)
	{echo count($trajets);}else {echo '12';}?> dernières Annonces</h3>
 <?php 
echo '
    <div id="swiper"class="swiper-container">

    <div class="swiper-wrapper">';
     $i=0;
   foreach ($trajets as $traj)
{ $cond=$manager->get($traj->id_conducteur());
$age=age($cond->date_naissance());
$voiture= $managerv->getlist($cond->id());
	if($i%4==0)
	{echo '
    <div class="swiper-slide">
    <div id="container">';
		}
		++$i;
		echo '<div id="section_an" style="color:#e8e9e9;">
<div id="ann_left">
<a style="cursor:pointer;" href="profil_conducteur.php?id='.$cond->id().'"><img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="70px" height="70px"/></a>
	 <p id="inform">
			<strong>'.$cond->prenom().'</strong><br>
            '.$age.' ans<br>
            '.$voiture[0]->marque().'<br>
            </p>
            <p style="text-align:center;"> <strong>Préférence de trajet:</strong><br>
';?>
<?php if(substr($cond->preference(),0,2)=="OF"){echo '<img src="images/yes-smoking-1560x2206.png" height="45px" width="45px" />';}
		elseif(substr($cond->preference(),0,2)=="NF") {echo '<img src="images/No_smoking_symbol.svg.png" height="45px" width="45px"/>';}?>
        
        <?php if(substr($cond->preference(),2,2)=="OM"){echo '<img src="images/music_icon_red_opt.svg" height="45px" width="45px"/>';}
		elseif(substr($cond->preference(),2,2)=="NM") {echo '<img src="images/no-music-md.png" height="45px" width="45px"/>';}?>
        
        <?php if(substr($cond->preference(),4,2)=="OA"){echo '<img src="images/petit-chien-accepte.png" height="45px" width="45px"/>';}
		elseif(substr($cond->preference(),4,2)=="NA") {echo '<img src="images/chien_interdit.gif" height="45px" width="45px"/>';}?>
  <?php echo '
   </p>         
            </div>
<div id="ann_right">
<div id="info_traj"> <strong style="margin-right:15px">'.utf8_encode($managerville->getn($traj->num_ville1())).'</strong><img src="images/forward.png" width="40px" height="20px" style="padding-top:"10px;"/>
<strong style="margin-left:15px">'.utf8_encode($managerville->getn($traj->num_ville2())).'</strong> <br>
<p style="margin-top:10px">Le '.$traj->date_aller().' à '.$traj->heure_aller().'</p>
</div>
<div id="traj_inf">
<span>'.$traj->prix().' DZD</span><br><span>';if($traj->nombre_place()==0){echo '<span style="color:red;font-size:16px;font-weight:bold;"> Complet';}else{echo $traj->nombre_place().' Places libres';}echo '</span>
</div><br><div style="margin-top:-;">Type : ';if($traj->type()=="A"){echo 'Aller';}
else { echo 'Aller-Retour';} echo '</div>
<a href="#annonce_affich'.$traj->num_trajet().'" onClick="show'.$traj->num_trajet().'()"><img src="images/button2.png" width="150px" height="40px" style="margin-top:40px; margin-left:150px;"/></a>
<script>
function show'.$traj->num_trajet().'(){
	document.getElementById("annonce_affich'.$traj->num_trajet().'").style.display= "block";
	document.getElementById("swiper").style.display= "none";
	
}
</script>


</div>
</div>';
		
		
		if($i==count($trajets) || $i%4==0)
		{ echo '</div>
    </div>';
		}
		}
echo '		
</div>
            <div class="swiper-pagination" style="position:static;margin-top:-10px;margin-left:605px;width:70px;padding:10px;  border-radius: 15px 50px;
            background-image:url(images/annonce1.png); background-position:center;"></div>
      </div>
      <script>
    var swiper = new Swiper(".swiper-container", {
        pagination: ".swiper-pagination",
        paginationClickable: true,
        spaceBetween: 30,
    });</script>';	
	
	?>
<?php 

foreach ($trajets as $traj)
{
echo
'<style>
#annonce_affich'.$traj->num_trajet().' {
width:100%;
height:100%;
opacity:.92;
top:0;
left:0;
padding-top:30px;
padding-left:150px;
display:none;
position:fixed;
background-color:#70b3a7;
overflow:auto;
}
#ann_aff_content{
	background-image:url(images/connexion.png);
	background-size:cover;
	color:white;
	padding:20px;
	width:76%;
	border-radius:5px;

}
#ann_aff_content input[type="submit"]{
width:100%;padding:15px 15px 15px 15px;border-radius:5px;border:#fa6c65;
                    margin-top:10px;color:white;
                                                   background-color:#ba5a75;}
#img_close
{position:absolute;
left:135px;
top:15px;
cursor:pointer;
}
</style>';
}
?>


    <?php 
	foreach ($trajets as $traj)
	{
		$cond=$manager->get($traj->id_conducteur());
$age=age($cond->date_naissance());
$voiture= $managerv->getlist($cond->id());
$commentaires=$managerco->getlist($traj->num_trajet());
	echo 
'<div id="annonce_affich'.$traj->num_trajet().'">
<img id="img_close" src="images/close-button.png" width="30px" height="30px" 
onClick="hide'.$traj->num_trajet().'()"/>
	<script>
	function hide'.$traj->num_trajet().'(){
	document.getElementById("annonce_affich'.$traj->num_trajet().'").style.display= "none";
	document.getElementById("swiper").style.display= "block";

	}
	</script>
	<div id="ann_aff_content">
		<div style=" display: -webkit-flex;
    display: flex;border:1px solid;width:59.2%;border-radius:5px;padding-left:400px;margin-bottom:10px;">
    
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
				{$cond=$manager->get($comm->id_conducteur()); echo ' 
			
					<div style="display: -webkit-flex;
    display: flex;">
					 <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;
					 margin-right:20px;margin-top:30px;" width="40px" height="40px"/>
					<div>
					<div style="margin-top:10px;margin-bottom:-10px;margin-left:30px;">
					<strong style="margin-right:5px;">'.ucfirst($cond->prenom()).'</strong><small> '.$comm->date_comm().'</small>
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
  ';if(($cond->id()==$conducteur->id()) && ($cond->nom()==$conducteur->nom()) && ($cond->prenom()==$conducteur->prenom()) && 
  ($cond->email()==$conducteur->email())){echo ' 
  <i class="fa fa-remove" onClick="showsupp'.$comm->id_commentaire().'()" style="color:pink;margin-top:55px;cursor:pointer; margin-left:10px;"></i>';} echo'
  </div>
  <div id="white-backgroundc'.$comm->id_commentaire().'">
</div>
<div id="dlgboxc'.$comm->id_commentaire().'">
    <div id="dlg-headerc">Confirmation</div>
    <div id="dlg-bodyc">Vous voulez vraiment supprimer ce commentaire ?</div>
    <div id="dlg-footerc" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="index_profil_conducteur.php" style=" margin-left:280px;">
	<input type="text" hidden="true" name="comm'.$comm->id_commentaire().'" id="comm'.$comm->id_commentaire().'">
	';$_SESSION['id_comm']=1;echo'
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
	</script>';}}}
  else
  { echo 'Aucun commentaire';} 
  echo'
  <div style="margin-bottom:40px;">
  <form method="post" action="index_profil_conducteur.php?num='.$traj->num_trajet().'">
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
							{echo '<span style="font-size:30px;font-weight:bolder; color:red;font-family:pacifico;">Complet</span><br>
							 ';} else {echo'
                             <span style="font-size:30px;font-weight:bolder; color:white;font-family:pacifico;">'.$traj->nombre_place().'</span><br>

                            <small>places restantes</small>';}echo'
                            </div>
                            </div>
                            <div style="padding:10px;">
					<form>
                    <select style="width:100%;padding:10px 15px 10px 15px;border-radius:5px;cursor:not-allowed;" disabled>
                    <option>1 place</option>
                    <option>2 places</option>
                    <option>3 places</option>
                    </select><br>

                    <input type="submit" value="Réserver" style="cursor:not-allowed;" disabled/>
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
                           <a style="cursor:pointer;" href="profil_conducteur.php?id='.$cond->id().'"> <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="70px" height="70px"/></a>
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
</div>
<div id="météo" style="margin-bottom:130px;">
<div id="logo_météo" >
<a href="#"><img src="images/méteo.png" width="150px" height="100px" /><br></a>
</div>
<img src="images/div5.png" style="margin-top:20px;margin-right:30px;"/>
</div>
</section>

<?php
require "footer.php";
?>

</div>
   
<script type="text/javascript">
$(function() {
	$( "#Datepicker2" ).datepicker({minDate:0,
		maxDate:365,
		dateFormat:"yy-mm-dd"}); 
});
</script>
</body>
</html>