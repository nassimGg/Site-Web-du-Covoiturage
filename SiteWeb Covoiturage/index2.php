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
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
	require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
	require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Commentairemanager.class.php');
require_once ('Commentaire.class.php');
$managerville=new VilleManager();
$villes=$managerville->villelist();
$managerv=new VoitureManager();
$managerp=new ParticipantManager();
$managerco=new CommentaireManager();
$managerc=new ConducteurManager();
$manager=new TrajetManager();
$trajets=$manager->getall();
$_POST['bouton_recherchexx']=1;
$managerville=new VilleManager();
$villes=$managerville->villelist();
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
</head>
<body>

<div id="bloc_page">
<header>
<!-- tête principal -->
<div id="titre_principal">

<a href="index2.php">
<div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:14px;"/></div>
<h2 id="site" style=" position:relative;top:-8px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
</a>
</div>
<!-- barre navigation -->
<nav>
<ul id="navigation">
<li ><a id="loginb" style="cursor:pointer"href="#"><div id="main">Connexion</div></a></li>
<li ><a  onclick="div_show()" style="cursor:pointer"><div id="main">Inscription</div></a></li>
<li ><a href="aide.php"><div id="main">Aide</div></a></li>
</ul>
</nav>
<!-- form login -->
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
document.getElementById('cond_png').style.display= 'block';
 document.getElementById('part_png').style.display= 'none';
document.getElementById('admin_png').style.display= 'none';

}
else if(this.selectedIndex == 1)
{
document.getElementById('part_png').style.display= 'block';
 document.getElementById('cond_png').style.display= 'none';
document.getElementById('admin_png').style.display= 'none';
}
else
{
document.getElementById('admin_png').style.display= 'block';
document.getElementById('part_png').style.display= 'none';
document.getElementById('cond_png').style.display= 'none';
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
													  <input type="email" name="email"class="text"  required placeholder="Mon e-mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Mon e-mail';}">
												</fieldset>
												<fieldset>
														<input type="password" name="mot_passe" required placeholder="Mon mot de passe" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
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
					   
<br>
<div style=" display: -webkit-flex;
    display: flex;">
<div id="logo-1"><img src="images/logo4.png" width="400px" height="206px" style="margin-left:50px;"/></div>
<div style="margin-left:150px;color:white;">
<h2 style="font-size:16px;">Nous offrons <span style="font-size:25px;font-weight:bold;">des trajets moins Economique</span></h2>
<p style="-webkit-flex-wrap: wrap;
    flex-wrap: wrap;width:420px;margin-top:-10px;">Bienvenue sur <span style="font-weight:bold;">E</span>tu<span style="font-weight:bold;">C</span>ovoiturage votre guichet unique pour partager votre voiture ou voyager moins chers en tout confiance.
S'il vous plaît jeter un oeil sur les services offerts.</p>
</div>
</div>
<!-- Form inscription -->
<div id="inscription2">
<div id="form_ins2">
<h1 style="text-align:center;">S'inscrire Maintenant!<span>Inscrivez vous et !</span></h1>
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
        <label>Telephone<input type="number" name="tel"/></label>
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
        <label>Photo <a style="margin-left:70px;" class='btn btn-primary' href='javascript:;'>
			Choisir photo...
			<input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);
            -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';opacity:0;
            background-color:transparent;color:transparent;" 
            name="image" size="40"  onchange="$('#upload-file-info').html($(this).val());"/>
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
          <input type="text" id="Datepicker3" name="date_naisc" required>    
        </label>
        <div style="margin-bottom:-30px;">
        <span style="color:red;font-size:25px;position:relative;left:300px;top:-50px;">*</span>
		</div>

        <label>Telephone<input type="number" name="telc"/></label>
       
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
        <label>Nombre de Place <input type="number" max="9" min="1" maxlength="1" name="place" required /></label>
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
        <label>Photo <a style="margin-left:70px;" class='btn btn-primary' href='javascript:;'>
			Choisir photo...
			<input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);
            -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';opacity:0;
            background-color:transparent;color:transparent;" 
            name="imagec" size="40"  onchange="$('#upload-file-info').html($(this).val());"/>
		</a>
		&nbsp;
		<span class="label label-info" id="upload-file-info"></span></label>
    </div>
           <div class="button-section">
     
      <button type="submit" name="bouton_signupc" style="cursor:pointer;border:none;background-color:white;margin-left:320px;"><img src="images/signup-icon.png"/></button>
    
        </div>

      </form>
           
    </div></div>
  </div></div>
 <br><br>
<div id="logo_recherche"><a href="#"><img src="images/rec1.png" width="150px" height="100px" style="margin-top:-30px; margin-left:-15px;"/></a></div>
<br>
<!-- Form recherche  -->
<div id="recherche">
<div id="contain_recherche">
<h2 style="font-size:40px; font-weight:bolder;margin-top:-40px;color:#003;">OÙ VEUX-TU ALLER ?</h2>
<h2 style="font-size:20px;color:#006;margin-top:-20px;">Tes covoiturages partout en Algerie</h2>
<form action="recherche_covoiturage.php#section2" method="post" class="idealforms" id="form_recherche">
<div id="vil_dep"><br>
<input id="vd"list="villes" required placeholder="Origine" name="depart" style="background-image: url(images/cercle_vert.png); height: 25px; background-size: 15px 20px; background-position: 5px 5px; border: 2px solid #ccc;
 border-radius: 4px; font-size: 16px; color: black; padding-top: 5px; padding-bottom: 5px;width:100%; padding-left: 30px; background-repeat: no-repeat;">
<datalist id="villes">
<?php foreach ($villes as $villee)
{$vill = utf8_encode($villee->nom_ville()); 
echo '<option value="', $vill,'">';
}?>
  </datalist> </div>

  <div id="vil_des"><br>
<input id="vde" type="text" name="dest" placeholder="Destination" style=" 
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
    background-repeat: no-repeat;" required list="villes"autocomplete="on">
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
<!-- Affichage la liste des 12 derniers trajets -->

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
if(isset($_POST['bouton_recherchexx']))
{
if(count($trajets)>0)
{
echo '
    <div id="swiper"class="swiper-container">
    <div class="swiper-wrapper">';
     $i=0;
   foreach ($trajets as $traj)
{ $cond=$managerc->get($traj->id_conducteur());
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
            <p style="text-align:center;"> <strong>Préférence de trajet:</strong><br>';?>
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
<p style="margin-top:10px;margin-left:-10px;">Le '.$traj->date_aller().' à '.$traj->heure_aller().'</p>
</div>
<div id="traj_inf">
<span>'.$traj->prix().' DZD</span><br><span style="margin-left:"5px;">';if($traj->nombre_place()==0){echo '<span style="color:red;font-size:16px;font-weight:bold;"> Complet';}else{echo $traj->nombre_place().' Places libres';}echo '</span>
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
	}
	else
	{ echo '<img src="images/alert.jpg" width="100%" style="margin-top:-10px;border-radius:5px;"/>';
	}
	}
	else
	{ echo '<img src="images/rechercher1.png" style="margin-left:250px;margin-top:100px;"/>';
	}
	
	
	
	
	?>
<?php 
if(isset($_POST['bouton_recherchexx']))
{
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
#ann_aff_content input[type="submit"],#submit{
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
		$cond=$managerc->get($traj->id_conducteur());
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
					else { echo utf8_encode($traj->description());}echo ' </p>
                    </div>
			<div style="margin-top:20px;">
			<span style="margin-top:20px;">Commentaires :</span><br>
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
  
  </div>
  <div id="white-backgroundc'.$comm->id_commentaire().'">
</div>';
  
  
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
  { echo '<div style="margin-top:30px;">Aucun commentaire</div>';} 
  echo'
  <div style="margin-bottom:40px;margin-top:30px;">
  Vous devez connecter pour pouvoir laisser un commentaire.
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
					<form method="post" action="reservation.php?id_participant=&num_trajet='.$traj->num_trajet().'" >
                    
					<select style="width:100%;padding:10px 15px 10px 15px;border-radius:5px;cursor:not-allowed"  disabled/>
                    <option checked>0 place</option>
                    </select><br>

                    <input id="submit" style="width:91%;cursor:not-allowed;" onclick="showDialog'.$traj->num_trajet().'()" value="Réserver" disabled/>
                    </form>';}
							else {echo '<span style="font-size:30px;font-weight:bolder; color:white;font-family:pacifico;">'.$traj->nombre_place().'</span><br>
							<small>places restantes</small>
							 </div>
                            </div>
                            <div style="padding:10px;">
					<form method="post" action="reservation.php?num_trajet='.$traj->num_trajet().'" >
                    <select style="width:100%;padding:10px 15px 10px 15px;border-radius:5px;cursor:pointer;" id="place'.$traj->num_trajet().'" />
					';for($i=1;$i<=$traj->nombre_place();$i++)
					{if($i==1)
					{echo '<option value="1" checked>1 place</option>';}
					else{
					echo '<option value="'.$i.'">'.$i.' places</option>';}}
					echo'
                    </select><br>

                    <input id="submit" style="width:91%;cursor:pointer;" onclick="showDialog'.$traj->num_trajet().'()" value="Réserver"/>
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
	<form method="post" action="reservation.php?num_trajet='.$traj->num_trajet().'"" style=" margin-left:280px;">
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
    </div>
    <!-- barre Météo -->
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
	$( "#Datepicker1" ).datepicker({
		maxDate:-6940,
		dateFormat:"yy-mm-dd"
	}); 
});
$(function() {
	$( "#Datepicker3" ).datepicker({
		maxDate:-6940,
		dateFormat:"yy-mm-dd"
	}); 
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