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
</head>
<body>

<div id="bloc_page">
<header>
<div id="titre_principal">
<a href="index2.php">
<div id="logo"><img src="images/logo.png" height="40px" width="40px" style="margin-left:140px; margin-top:12px;"/></div>
<h2 id="site" style=" position:relative;top:-10px;color:white; margin-left:10px;"><span style="border-right:1px solid; padding-right:15px;position:relative;top:-2px">E<span style="font-size:0.65em">tu</span>C<span style="font-size:0.65em">ovoiturage</span></span><span class="premier">PREMIER SITE DE COVOITURAGE Á SÉTIF</span></h2>
</a>
</div>
<nav>
<ul id="navigation">
<li ><a  onclick="div_show()" style="cursor:pointer">Inscription</a></li>
<li ><a href="aide.php">Aide</a></li>
</ul>
</nav>

					   
<br>
<div id="logo-1"><img src="images/logo-1.png" width="400px" height="206px"
style="margin-left:50px;"/></div>
<br><br><br><br><br>
<div id="inscription">
<div id="form_ins">
<h1>S'inscrire Maintenant!<span>Sign up and tell us what you think of the site!</span></h1>
<div class="section"><span>1</span>
Type</div>
<div class="inner-wrap1">
<label>Vous étes ?<input type="radio" name="type" onClick="form_show()"/>Passager
				 <input type="radio" name="type" onClick="form_hide()"/>Conducteur</label>
      </div>
      <img id="close" src="images/close-button.png" width="30px" height="30px" onClick="div_hide()"/>
<form id="form_p" hidden="true">

	   <div class="section"><span>2</span>
Informations Personnelles</div>
    <div class="inner-wrap">
    	<label>Sexe <input type="radio" name="sexe" />Male <input type="radio" name="sexe"/>Femelle</label>
        <label>Nom <input type="text" name="field1" /></label>
        <label>Prénom <input type="text" name="field2"/></label>
        <label>Date naissance
          <input type="text" id="Datepicker1">
          
        </label>
        <label>Telephone<input type="tel"/></label>
    </div>

    <div class="section"><span>3</span>E-mail</div>
    <div class="inner-wrap">
        <label>Email Address <input type="email" name="field3" /></label>
    </div>

    <div class="section"><span>4</span>Mot de Passe</div>
        <div class="inner-wrap">
        <label>Mot de passe<input type="password" name="field5" /></label>
        <label>Confirmer mot de passe <input type="password" name="field6" /></label>
        </div>
        <div class="button-section">
     <input type="submit" name="Sign Up" Value="S'inscrire"/>
    </div>
      </form>
      
      <form id="form_v" hidden="true">

	   <div class="section"><span>2</span>
Informations Personnelles</div>
    <div class="inner-wrap">
    	<label>Sexe <input type="radio" name="sexe" />Male <input type="radio" name="sexe"/>Femelle</label>
        <label>Nom <input type="text" name="field1" /></label>
        <label>Prénom <input type="text" name="field2"/></label>
        <label>Date naissance
          <input type="text" id="Datepicker1">
          
        </label>
        <label>Telephone<input type="tel"/></label>
    </div>

    <div class="section"><span>3</span>E-mail</div>
    <div class="inner-wrap">
        <label>Email Address <input type="email" name="field3" /></label>
    </div>

    <div class="section"><span>4</span>Mot de Passe</div>
        <div class="inner-wrap">
        <label>Mot de passe<input type="password" name="field5" /></label>
        <label>Confirmer mot de passe <input type="password" name="field6" /></label>
        </div>
        <div class="section"><span>5</span>Voiture</div>
        <div class="inner-wrap">
        <label>Numéro Immatriculation<input type="text" name="field5" /></label>
        <label>Marque <input type="text" name="field6" /></label>
        <label>Nombre de Place <input type="number" max="4" min="1" maxlength="1"name="field6" /></label>
        <label>Année <input type="number" name="field6" /></label>
        <label>Couleur <input type="text" name="field6" /></label>
        <label>Kilométrage <input type="number" name="field6" /></label>
        </div>    <div class="button-section">
     <input type="submit" name="Sign Up" Value="S'inscrire"/>
    </div>
        
      </form>
    </div>
  </div>
  </header>
<section>
<div id="lognbox">                
									<form id="loginfor" action="login.php" method="post">
                                    
                                    <div id="error">
        <?php
			if(isset($_GET['erreur']))
			{
				?>
                <div class="alert alert-danger">
                   <i class="glyphicon glyphicon-warning-sign"></i> &nbsp; <?php echo $error; ?> !
                </div>
                <?php
			}
		?>
        </div>
                                    <fieldset id="body">
                                    <h1 style="text-align:center;color:white;margin-top:-10px;font-size:35px;margin-bottom:10px;">Connexion</h1>
                                           <div class="buttonss">
					<ul>
						<li id="face"><a href="#" class="hvr-sweep-to-right">Connexion avec Facebook</a></li>	
					</ul>
					<div class="clear"></div>
                    
				</div> <img src="images/ou1.png" width="420px" style="margin-top:10px; margin-left:px;margin-bottom:0px; ">
											
												<fieldset>
													  <input type="email" name="email"class="text"  required placeholder="Mon e-mail" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'E Mail Address';}">
												</fieldset>
												<fieldset>
														<input type="password" name="mot_passe"placeholder="Mon mot de passe" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Password';}">
											  </fieldset>
												<input type="submit" id="login" name="bouton_login" value="Connexion">
												<label for="checkbox" style="margin-right:30px;"><input type="checkbox" id="checkbox"> <i>Se souvenir de moi</i></label>
											</fieldset>
										<span><a href="#">Mot de passe oublié</a></span><br>
                                        <div style="float:right;margin-top:10px;">
                                        <span style="color:white;margin-left:40px">Pas encore membre ?<br></span>
<span style=""><a href="#">Inscrivez-vous gratuitement</a></span></div>
								 </form>
								 					
  </div>
  
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
	$( "#Datepicker2" ).datepicker(); 
});
</script>
</body>
</html>