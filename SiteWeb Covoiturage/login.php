<?php 
session_start();
require_once ('dbconfig.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Administrateurmanager.class.php');
require_once ('Administrateur.class.php');
if(isset($_POST['type']))
{
if ($_POST['type']=="participant")
{ $manager = new ParticipantManager();$b=0;$b1=0;
	if($manager->is_loggedin()!="")
	{
		$y=$_SESSION['annonce'];
		if($y==1)
		{$b1=1;
			$manager->redirect('publier_annonce.php');
		}
		$x=$_SESSION['reserv'];
		if($x==1)
		{$b=1;
			$manager->redirect('reservation.php?bouton=1&id_participant='.$_SESSION['user_part'].'&num_trajet='.$_SESSION['num_trajet'].'&place='.$_SESSION['place']);
		}
		if($b!=1 && $b1!=1)
		{
	$manager->redirect('participant.php');}
	}

	if(isset($_POST['bouton_login']))
	{
		$part=new Participant(array('email'=>$_POST['email'],'mp'=>$_POST['mot_passe']));
  
 		if($manager->login($part))
 		{
			$y=$_SESSION['annonce'];
		if($y==1)
		{$b1=1;
				$manager->redirect('publier_annonce.php');
			}
			$x=$_SESSION['reserv'];
			if($x==1)
			{$b=1;
				$manager->redirect('reservation.php?bouton=1&id_participant='.$_SESSION['user_part'].'&num_trajet='.$_SESSION['num_trajet'].'&place='.$_SESSION['place']);
			}
		if($b!=1 && $b1!=1)
		$manager->redirect('participant.php');
 
 		}
 		else
 		{
  			$error="Votre e-mail ou votre mot de passe sont erronés";
 		} 
	}
}
elseif ($_POST['type']=="conducteur")
{$manager = new ConducteurManager();$a=0;$a1=0;
	if($manager->is_loggedin()!="")
	{
		$y=$_SESSION['annonce'];
			if($y==1)
		{$a1=1;
			$manager->redirect('publier_annonce.php');
		}
		$x=$_SESSION['reserv'];
			if($x==1)
		{$a=1;
			$manager->redirect('index2.php');
		}
		if($a!=1 && $a1!=1)
		{
		$manager->redirect('conducteur.php');}
	}

	if(isset($_POST['bouton_login']))
	{
		$cond=new Conducteur(array('email'=>$_POST['email'],'mp'=>$_POST['mot_passe']));
  
 		if($manager->login($cond))
 		{
			$y=$_SESSION['annonce'];
			if($y==1)
		{$a1=1;
$manager->redirect('publier_annonce.php');
		
			}
			$x=$_SESSION['reserv'];
			if($x==1)
			{$a=1;
				$manager->redirect('reservation.php');
			}
			if($a!=1 && $a1!=1)
			{
			$manager->redirect('conducteur.php');}
 		}
		 else
 		{
  			$error="Votre e-mail ou votre mot de passe sont erronés";
 		} 
	}
}
elseif ($_POST['type']=="administrateur")
{
	$manager = new AdministrateurManager();$c=0;$c1=0;
if($manager->is_loggedin()!="")
{
	$y=$_SESSION['annonce'];
			if($y==1)
		{$a1=1;$manager->redirect('publier_annonce.php');
	}
	$x=$_SESSION['reserv'];
			if($x==1)
		{$a=1;
		$manager->redirect('reservation.php');
	}
	if($a!=1 && $a1!=1){
	$manager->redirect('admin.php');}
}

if(isset($_POST['bouton_login']))
{
$admin=new Administrateur(array('email'=>$_POST['email'],'mp'=>$_POST['mot_passe']));
  
 if($manager->login($admin))
 {
	 $y=$_SESSION['annonce'];
			if($y==1)
		{$a1=1;
		$manager->redirect('publier_annonce.php');
	}
	$x=$_SESSION['reserv'];
			if($x==1)
		{$a=1;
		$manager->redirect('reservation.php');
	}
	if($a!=1 && $a1!=1){
	$manager->redirect('admin.php');}
 }
 else
 {
  $error="Votre e-mail ou votre mot de passe sont erronés";
 } 
}
}

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
<link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
<link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
<title>Identification | ETU Covoiturage</title>
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
<header id="header">
<div id="titre_principal">
<a href="index2.php">
<div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
<h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
</a>
</div>
<nav>
<ul id="navigation">
<li ><a  onclick="div_show1()" style="cursor:pointer"><div id="main">Inscription</div></a></li>
<li ><a href="aide.php"><div id="main">Aide</div></a></li>
</ul>
</nav>

					   
<br>
<br>
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
  </header>
<section>
 <div id="error" style="margin-top:50px;">
        <?php
			if(isset($error))
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
<div id="lognbox">                
									<form id="loginfor" action="login.php" method="post">
                                    
                                   
                                    <fieldset id="body">
                                    <h1 style="text-align:center;color:white;margin-top:-10px;font-size:35px;margin-bottom:10px;">Connexion</h1>
                                           <div id="button" class="buttonss">
					<ul>
						<li id="face"><a href="#" class="hvr-sweep-to-right">Connexion avec Facebook</a></li>	
					</ul>
					<div class="clear"></div>
                    
				</div> <img src="images/ou1.png" width="420px" style="margin-top:10px; margin-left:px;margin-bottom:0px; ">
											
                                    <fieldset>
                                          <label style="margin-left:60px;color:white;font-size:16px;"> Vous êtes?
                                           <select  onchange="if(this.selectedIndex == 0)
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
                                           name="type" id="typee" style="padding:5px 8px 5px 40px;margin-left:50px;height:30px;width:50%;border-radius:5px;">          
                                           <option value="conducteur" onClick="showp()">Conducteur</option>
                                           <option value="participant" onClick="showp()">Participant</option>
                                           <option value="administrateur" onClick="showp()">Administrateur</option>
                                           </select>

                                           <div style="margin-top:10px;margin-bottom:-30px;">
                                           <img src="images/car_v.png" width="60px" height="60px" id="cond_png" style="margin-left:170px;"/>
                                           <img src="images/Immigration.png" hidden="true" width="60px" height="60px" id="part_png" style="margin-left:170px;"/>
                                           <img src="images/mss-mssm-icon.png" hidden="true" width="60px" height="60px" id="admin_png" style="margin-left:170px;"/>
                                          </div>
                                           </label>
                                           </fieldset>
                                    
												<fieldset>
													  <input type="email" name="email"class="text"  required placeholder="Mon e-mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E Mail Address';}">
												</fieldset>
												<fieldset>
														<input type="password" name="mot_passe"placeholder="Mon mot de passe" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
											  </fieldset>
												<input type="submit" id="login" name="bouton_login" value="Connexion">
												

                                                <label id="check" for="checkbox" ><input type="checkbox" id="checkbox"> <i>Se souvenir de moi</i></label>
											<style>
											#check
											{float:right;margin-right:30px;}
                                            </style>
                                            </fieldset>
										<span><a href="#">Mot de passe oublié</a></span><br>
                                        <div style="float:right;margin-top:10px;">
                                        <span style="color:white;margin-left:40px">Pas encore membre ?<br></span>
<span style=""><a href="inscription.php">Inscrivez-vous gratuitement</a></span></div>
								 </form>
								 					
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
		dateFormat:"yy-mm-dd"}); 
});
$(function() {
	$( "#Datepicker3" ).datepicker({
				maxDate:-6940,
		dateFormat:"yy-mm-dd"}); 
});
</script>
</body>
</html>