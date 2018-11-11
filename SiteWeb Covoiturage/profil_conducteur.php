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
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<!--[if lt IE 9]>
<script src="http://html5shiv.googlecode.com/svn/trunk/html5.js">
</script>
<![endif]-->

<link rel="stylesheet" href="css/style1.css" />
<link rel="stylesheet" href="css/style2.css" />
<link rel="stylesheet" href="css/swiper.min.css" type="text/css">
<link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css" type="text/css">
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<title>ETU Covoiturage</title>
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
<ul id="navigation1"  style="margin-left:-340px;">
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
{echo '<header id="header">
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
									<form id="loginForm" action="login.php" method="POST">
                                    
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
												<input type="submit" id="login" name="bouton_login"value="Connexion">
												<label for="checkbox"><input type="checkbox" id="checkbox"> <i>Se souvenir de moi</i></label>
											</fieldset>
										<span><a href="#">Mot de passe oublié</a></span>
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

?>
  
</header>
<section id="se" style="margin-top:40px;">
<?php
echo '
<section class="content" style="display: -webkit-flex;
    display: flex;-webkit-flex-wrap: wrap;
    flex-wrap: wrap;margin-top:10px; 
     background-repeat:no-repeat; background-size:cover;color:black;padding:20px;border-radius:5px;">
        
        <div style="margin-right:50px;margin-left:150px;padding:15px;border:1px solid gray;
		border-radius:5px;width:23%;height:auto;">
        
       
        <div style="margin-bottom:8px;">
        <strong style="font-size:23px;" >Activité </strong><br>
		</div>
       <div style="margin-bottom:8px;"> <span style="margin-bottom:5px;font-size:16px;color:gray">Annonces publiée : '.$nombre.'</span></div>
       <div style="margin-bottom:10px;"> <span style="margin-bottom:15px;font-size:16px;color:gray">Date d&acute;inscription : '.$condu->date_inscription().'</span></div>
        
        <div style="border-top:1px solid gray;padding-top:5px;">
        <div style="margin-bottom:13px;margin-top:10px;">
        <strong style="font-size:23px;padding-bottom:10px;" >Véhicule </strong><br>
		</div>';if($voitures[0]->photo()!=""){echo '<img src="profil_photo/'.$voitures[0]->photo().'" style="display: block;
    border: 4px double #E6E6E6;margin-bottom:-10px;"/>';} else {echo '
        <img src="images/car.png" style="display: block;
    border: 4px double #E6E6E6;margin-bottom:-10px;"/>';}echo '<br>

       <div style="margin-bottom:8px;"> <span style="font-size:16px;color:gray;">'.$voitures[0]->marque().'</span></div>
       <div style="margin-bottom:8px;"> <span style="font-size:16px;color:gray;">Année : '.$voitures[0]->annee().'</span></div>
       <div style="margin-bottom:10px;"> <span style=";font-size:16px;color:gray">Couleur : '.ucfirst($voitures[0]->couleur()).'</span></div>
        
        </div>
        </div>
       
        <div>
        <div style="display: -webkit-flex;
    display: flex;padding:10px 10px 10px 15px;border-radius:5px;
    color:black;">
        <img src="profil_photo/'.$condu->photo().'" height="140px" width="140px" style="border-radius:100%;" />

        <div style="margin-left:50px;">
        
        <strong style="font-size:23px;">'.ucfirst($condu->prenom()).' '.ucfirst(substr($condu->nom(),0,1)).'</strong><br>
<small style="font-size:16px;color:gray;">('.age($condu->date_naissance()).' ans)</small><br>
';if($condu->tel()!=""){echo'
<small style="font-size:16px;color:black;">Numéro téléphone : '.$condu->tel().'</small><br>';}echo'
<div style="display: -webkit-flex;
    display: flex;margin-top:7px;">
<p style="color:gray;"> Mes préférences : </p>';?>
<?php if(substr($condu->preference(),0,2)=="OF"){echo '<img src="images/yes-smoking-1560x2206.png" height="45px" width="45px" style="margin-left:10px;" />';}
		elseif(substr($condu->preference(),0,2)=="NF") {echo '<img src="images/No_smoking_symbol.svg.png" height="45px" width="45px" style="margin-left:10px;"/>';}?>
        
        <?php if(substr($condu->preference(),2,2)=="OM"){echo '<img src="images/music_icon_red_opt.svg" height="45px" width="45px"/>';}
		elseif(substr($condu->preference(),2,2)=="NM") {echo '<img src="images/no-music-md.png" height="45px" width="45px"/>';}?>
        
        <?php if(substr($condu->preference(),4,2)=="OA"){echo '<img src="images/petit-chien-accepte.png" height="45px" width="45px"/>';}
		elseif(substr($condu->preference(),4,2)=="NA") {echo '<img src="images/chien_interdit.gif" height="45px" width="45px"/>';}?>
<?php echo '
<br>
</div>
        </div>
</div>
<div class="dialogbox" style="margin-top:-15px;">
    <div class="body">
      <span class="tip tip-up"></span>
      <div class="message" id="message">
        <span style="word-wrap: break-word;">';if($condu->minibio()!=''){echo utf8_encode($condu->minibio());}else {echo'Je n&acute;ai pas encrore rédigé de minibio';}echo'</span>
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
';
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