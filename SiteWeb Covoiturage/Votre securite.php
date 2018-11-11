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

require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
require_once ('Administrateurmanager.class.php');
require_once ('Administrateur.class.php');
$managerv=new VoitureManager();
$managert=new TrajetManager();
$managerp=new ParticipantManager();
$managerc=new ConducteurManager();
$managera=new AdministrateurManager();
if(isset($_GET['id']))
{$id=$_GET['id'];
	$condu=$managerc->get($id);
	$nombre=$managert->countt($id);
	$voitures=$managerv->getlist($id);
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
<title>Votre sécurité | ETU Covoiturage</title>
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
 <?php 
if($managerp->is_loggedin())
{$id1=$_SESSION['user_part'];
$part=$managerp->get($id);
echo '<header id="header">
  <div id="titre_principal"> <a href="index_profil_passager.php">
    <div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
    <h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
    </a> </div>
<nav>
<ul id="navigation1">
<li ><a style="cursor:pointer"href="logout.php"><span id="main">Déconnecter</span></a></li>
<li id="profilc"><a id="profilb" href="#"style="padding:5px;border-radius:5px;cursor:pointer;width:50%"><img src="images/passenger-male-18.png" width="18px" height="18px" style="border-radius:100%;margin-right:3px;padding-top:px;display:inline-block;top:3px;position:relative;"/><span id="main"> '.ucfirst($part->prenom()).'</span> <i id="carret"></i></a>
<ul id="profilBox" style="list-style-type:none;">
		<div id="details_profil">
			<li style=""><a href="participant.php" style="cursor:pointer; color:inherit;">Tableau de bord</a></li>
			<li  style="height:1px;border-bottom:0.5px solid #000;width:100%;padding:0px"></li>
			<li style=""><a href="participant_reservation.php" style="cursor:pointer;color:inherit;">Vos reservations</a></li>
			<li ><a href="participant_information.php" style="cursor:pointer;color:inherit;">Profil</a></li>
			<li ><a href="logout.php" style="cursor:pointer;color:inherit;">Se déconnecter</a></li>
		</div>
</ul>
</li>
</ul>
</nav>';
}
elseif($managerc->is_loggedin())
{$id2=$_SESSION['user_cond'];
$cond=$managerc->get($id2);
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
else
{echo '
<style>
.label-info {
    background-color: #5bc0de;
}
.label {
    display: inline-block;
    padding: .25em .4em;
    font-size: 75%;
    font-weight: 700;
    line-height: 1;
    color: #fff;
    text-align: center;
    white-space: nowrap;
    vertical-align: baseline;
    border-radius: .25rem;
}

.btn-default, .btn-primary, .btn-success, .btn-info, .btn-warning, .btn-danger {
    text-shadow: 0 -1px 0 rgba(0,0,0,0.2);
    -webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075);
    box-shadow: inset 0 1px 0 rgba(255,255,255,0.15),0 1px 1px rgba(0,0,0,0.075);
}

.btn-primary {
    color: #fff;
    background-color: #428bca;
    border-color: #357ebd;
}
.btn-cons {
    margin-right: 5px;
    min-width: 120px;
    margin-bottom: 8px;
}
.btn {
    display: inline-block;
    padding: 9px 12px;
    padding-top: 7px;
    margin-bottom: 0;
    font-size: 14px;
    line-height: 20px;
    color: #5e5e5e;
    text-align: center;
    vertical-align: middle;
    cursor: pointer;
    background-color: #d1dade;
    -webkit-border-radius: 3px;
    -webkit-border-radius: 3px;
    -webkit-border-radius: 3px;
    background-image: none !important;
    border: none;
    text-shadow: none;
    box-shadow: none;
    transition: all 0.12s linear 0s !important;
    font: 14px/20px "Helvetica Neue",Helvetica,Arial,sans-serif;
}
.btn-primary {
    color: #fff;
    background-color: #428bca;
    border-color: #357ebd;
}
.btn {
    display: inline-block;
    padding: 6px 12px;
    margin-bottom: 0;
    font-size: 14px;
    font-weight: normal;
    line-height: 1.428571429;
    text-align: center;
    white-space: nowrap;
    vertical-align: middle;
    cursor: pointer;
    background-image: none;
    border: 1px solid transparent;
    border-radius: 4px;
    -webkit-user-select: none;
    -moz-user-select: none;
    -ms-user-select: none;
    -o-user-select: none;
    user-select: none;
}
</style>
<header id="header">
  <div id="titre_principal"> <a href="index2.php">
    <div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
    <h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
    </a> </div>
<nav>
<ul id="navigation">
<li ><a id="loginb" style="cursor:pointer"href="#"><div id="main">Connexion</div></a></li>
<li ><a  onclick="div_show()" style="cursor:pointer"><div id="main">Inscription</div></a></li>
<li ><a href="aide.php"><div id="main">Aide</div></a></li>
</ul>
</nav>

<div id="loginBox">                
									<form id="loginForm" action="login.php" method="post">
                                    
                                    <div class="buttons">
					<ul>
						<li><a href="#" class="hvr-sweep-to-right">Connexion avec Facebook</a></li>	
					</ul>
					<div class="clear"></div>
                    
				</div> <img src="images/ou.png" style="margin-top:-130px; margin-left:17px;margin-bottom:-40px; ">
											<fieldset id="body">
                                           <fieldset>
                                          <label style="margin-left:20px;color:black;font-size:16px;"> Vous êtes?
                                           <select onchange="if(this.selectedIndex == 0)
{
document.getElementById("cond_png").style.display= "block";
 document.getElementById("part_png").style.display= "none";
document.getElementById("admin_png").style.display= "none";

}
else if(this.selectedIndex == 1)
{
document.getElementById("part_png").style.display= "block";
 document.getElementById("cond_png").style.display= "none";
document.getElementById("admin_png").style.display= "none";
}
else
{
document.getElementById("admin_png").style.display= "block";
document.getElementById("part_png").style.display= "none";
document.getElementById("cond_png").style.display= "none";
}"
                                           name="type" id="typee" style="padding:5px 8px 5px 8px;margin-left:10px;height:30px;width:130px;border-radius:5px;">          
                                           <option value="conducteur" onClick="showp()">Conducteur</option>
                                           <option value="participant" onClick="showp()">Participant</option>
                                           <option value="administrateur" onClick="showp()">Administrateur</option>
                                           </select>

                                           <div style="margin-top:10px;margin-bottom:-30px;">
                                           <img src="images/volant.png" width="60px" height="60px" id="cond_png" style="margin-left:120px;"/>
                                           <img src="images/Immigration.png" hidden="true" width="60px" height="60px" id="part_png" style="margin-left:120px;"/>
                                           <img src="images/mss-mssm-icon.png" hidden="true" width="60px" height="60px" id="admin_png" style="margin-left:120px;"/>
                                          </div>
                                           </label>
                                           </fieldset>
												<fieldset>
													  <input type="email" name="email"class="text"  required placeholder="Mon e-mail" onfocus="this.value = "";" onblur="if (this.value == "") {this.value = "Mon e-mail";}">
												</fieldset>
												<fieldset>
														<input type="password" name="mot_passe" required placeholder="Mon mot de passe" onfocus="this.value = "";" onblur="if (this.value == "") {this.value = "Password";}">
											  </fieldset>
	        <button type="submit" name="bouton_login" style="cursor:pointer;border:none;background-color:#33CCFF;margin-left:5px;"><img src="images/login-icon.png" width="120px"/></button>											
                                                <div style=" display: -webkit-flex;margin-top:-50px;
    display: flex;"><input type="checkbox" style="margin-right:-125px;margin-left:20px;margin-top:5px;" id="checkbox"> <i style="margin-left:0px;color:white;">Se souvenir de moi</i></div>
											</fieldset>
                                            <div style="margin-top:20px;">
										<span style=""><a href="#">Mot de passe oublié</a></span>
                                        </div>
								 </form>
								 					
  </div>
  
  <div id="inscription2">
<div id="form_ins2">
<h1 style="text-align:center;">S&acute;inscrire Maintenant!<span>Inscrivez vous et !</span></h1>
<div class="section"><span>1</span>
Type</div>
<div class="inner-wrap1">
<div>
<label style="text-align:center;">Vous étes ?<input type="radio" style="margin-left:50px;"  name="type" value="participant" onClick="form_show()" />Participant
<input type="radio" style="margin-left:50px;" name="type" value="conducteur" onClick="form_hide()" />Conducteur</label>
      </div>
      <img id="close" src="images/close-button.png" width="30px" height="30px" onClick="div_hide()"/>
      <div id="form_p" hidden="true" >
<form  method="post"  action="inscription.php">
		<div id="form_passager">
		<div style="width:350px;margin-right:100px;">
	   <div class="section"><span>2</span>
Informations Personnelles</div>
    <div class="inner-wrap">
    	<label>Sexe <input type="radio" name="sexe" checked value="M"/>Male <input type="radio" name="sexe" value="F"/>Femelle</label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-35px;">*</span>
		</div>
        <label>Nom <input type="text" name="nom" required/></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Prénom <input type="text" name="prenom" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Date naissance
          <input type="text" id="Datepicker1" name="date_nais" required>
          
        </label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Telephone<input type="number" name="tel" /></label>
    </div>
	</div>
    <div style="width:350px;">
    <div class="section"><span>3</span>E-mail</div>
    <div class="inner-wrap">
        <label>Email Address <input type="email" name="email"required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
    </div>
    
    <div class="section"><span>4</span>Mot de Passe</div>
        <div class="inner-wrap">
        <label>Mot de passe<input type="password" name="mot_passe" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Confirmer mot de passe <input type="password" name="mot_passe1" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        </div>
      </div>  
      </div>
	 
	  <div class="section"><span>5</span>Photo</div>
    <div class="inner-wrap" style="height:30px;">
        <label>Photo <a style="margin-left:70px;" class=';?>'btn btn-primary' href='javascript:;'<?php echo '>
			Choisir photo...
			<input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);
            -ms-filter:';?>'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)'<?php echo ';opacity:0;
            background-color:transparent;color:transparent;" 
            name="image" size="40"  onchange="$(';?>'#upload-file-info'<?php echo ').html($(this).val());"/>
		</a>
		&nbsp;
		<span class="label label-info" id="upload-file-info"></span></label>
        
    </div>
        <div class="button-section" style="margin-left:320px;">
        <button type="submit" name="bouton_signup" style="cursor:pointer;border:none;background-color:white;"><img src="images/signup-icon.png"/></button>
    </div>
      </form>
      </div>
      <div id="form_v" hidden="true">
      <form  method="post" action="inscription.php">
      <div id="form_passager">
	<div  style="width:350px;margin-right:100px;">
	   <div class="section"><span>2</span>
Informations Personnelles</div>
    <div class="inner-wrap">

    	<label>Sexe <input type="radio" name="sexec" value="M" checked/>Male 
        <input type="radio" value="F" name="sexec"/>Femelle</label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-35px;">*</span>
		</div>
        <label>Nom <input type="text" name="nomc" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Prénom <input type="text" name="prenomc" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Date naissance
          <input type="text" id="Datepicker1" name="date_naisc" required>    
        </label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>

        <label>Telephone<input type="number" name="telc" required /></label>
       
    </div>
</div>
	<div style="width:350px;">
    <div class="section"><span>3</span>E-mail</div>
    <div class="inner-wrap">
    
        <label>Email Address <input type="email" name="emailc" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
    </div>

    <div class="section"><span>4</span>Mot de Passe</div>
        <div class="inner-wrap">
        <label>Mot de passe<input type="password" name="mot_passec" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        <label>Confirmer mot de passe <input type="password" name="mot_passec1" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>
        </div>
     </div>
     <div>
        <div class="section"><span>5</span>Voiture</div>
        <div class="inner-wrap" id="voiture" style="width:131%">
        <div style="width:41%;">
        <label>Numéro Immatriculation<input type="text" name="num_imm" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:320px;top:-50px;">*</span>
		</div>
        <label>Marque <input type="text" name="marque" /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:320px;top:-50px;">*</span>
		</div>
        <label>Nombre de Place <input type="number" max="9" min="1" maxlength="1"name="place" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:320px;top:-50px;">*</span>
		</div>
        </div>
        <div style="margin-left:130px;width:40%;">
        <label>Année <input type="number" name="annee" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:320px;top:-50px;">*</span>
		</div>
        <label>Couleur <input type="text" name="couleur" required /></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:320px;top:-50px;">*</span>
		</div>
        <label>Kilométrage <input type="number" name="kilo" required/></label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:320px;top:-50px;">*</span>
		</div>
        </div>
        </div> 
        </div>
        </div>
		<div class="section"><span>6</span>Photo</div>
    <div class="inner-wrap" style="height:30px;">
        <label>Photo <a style="margin-left:70px;" class=';?>'btn btn-primary' href='javascript:;'<?php echo '>
			Choisir photo...
			<input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);
            -ms-filter:';?>'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)'<?php echo ';opacity:0;
            background-color:transparent;color:transparent;" 
            name="imagec" size="40"  onchange="$(';?>'#upload-file-info'<?php echo ').html($(this).val());"/>
		</a>
		&nbsp;
		<span class="label label-info" id="upload-file-info"></span></label>
        
    </div>

           <div class="button-section">
     
      <button type="submit" name="bouton_signupc" style="cursor:pointer;border:none;background-color:white;margin-left:320px;"><img src="images/signup-icon.png"/></button>
    
        </div>

      </form>
            
    </div></div>
  </div>';
	
}

?> </header>
<section id="section" style="height:500px;margin-top:-60px;">
<div id="element">
	<ul>
		<li><a href="a propos du covoiturage.php">A propos du Covoiturage</a></li>
        <li><a href="comment ca marche.php">Comment ça marche ?</a></li>
        <li class="active"><a href="votre securite.php">Votre sécurité</a></li>
        <li><a href="contactez nous.php">Contactez nous</a></li>
        </ul>
</div>
<div id="element" style="margin-top:100px;margin-left:200px;font-size:16px;color:black;margin-right:70px;">
<h1 style="font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif;">Votre sécurité</h1>
<p style=" font-family:'Lucida Grande', 'Lucida Sans Unicode', 'Lucida Sans', 'DejaVu Sans', Verdana, sans-serif; text-align:center;font-size:16px; text-justify:tibetan;">Nous mettons tout en oeuvre pour que EtuCovoiturage.com soit le plus sûr possible. Nous vérifions au maximum l'identité de nos membres grâce par exemple à la certification de leur numéro de téléphone mobile. Ensuite la communauté utilise les profils et les avis pour évaluer les membres et mettre de côté ceux qui ne respectent pas l'esprit de la consommation collaborative. Enfin, EtuCovoiturage.com a une équipe Relations Membres dédiée, disponible tous les jours pour aider nos membres à utiliser au mieux notre service de covoiturage.

EtuCovoiturge.com vérifie tout le contenu publié sur le site et s'assure que les échanges entre les membres soient toujours responsables et cordiaux. Toutes les photos, commentaires et profils sont vérifiés pour garantir la confiance au sein de la communauté, et vous fournir un service fiable et de bonne qualité.

Sur EtuCovoiturage.com , vous choisissez avec qui vous allez voyager. Les passagers choisissent les conducteurs de leur choix, et de leur côté, les conducteurs acceptent ou déclinent rapidement les demandes.

Lors de l’inscription, EtuCovoiturage.com vous demande votre vrai nom (pseudonyme interdit) et une vraie photo (autre interdit). En plus de certifier votre email et votre numéro de téléphone pour rassurer toute les personnes sur votre identité .
</p></div>
</section>
<?php
require "footer.php";
?>
</div>
</body>
</html>