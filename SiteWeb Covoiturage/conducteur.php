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
require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
$managert=new TrajetManager();
$managerv=new VoitureManager();
$id=$_SESSION['user_cond'];
$manager=new ConducteurManager();
$cond=$manager->get($id);
$voiture=$managerv->getlist($cond->id());
?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tableau de bord | EtuCovoiturage</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
    <link rel="stylesheet" href="css/bootstrap.min.css">
   

        <link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">
 <link rel="icon" type="images/png" href="images/title.gif"/>
    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/profil.min.css">

    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">

<style>
#lien a{color:black;}
	  #lien a:hover{color:white;}
       </style>
  <script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
  </head>

  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

      <header class="main-header">
        <a href="index_profil_conducteur.php" class="logo">

          <span class="logo-mini"><b>EC</b></span>
          <span class="logo-lg"><b>E</b>tu<b>C</b>ovoiturage</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

              <li class="dropdown user user-menu">

                <a href="#" class="dropdown-toggle" data-toggle="dropdown">

                  <img src="profil_photo/<?php echo $cond->photo();?>" class="user-image" alt="User Image">
                 
                  <span class="hidden-xs"><?php echo ucfirst($cond->prenom());?></span>
                </a>
                <ul class="dropdown-menu">
   
                  <li class="user-header">
                    <img src="profil_photo/<?php echo $cond->photo();?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo ucfirst($cond->prenom()).' '.ucfirst($cond->nom());?>
                    
                    </p>
                  </li>
                
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="conducteur_information.php" class="btn btn-default btn-flat">Profil</a>
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
              <img src="profil_photo/<?php echo $cond->photo();?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($cond->prenom());?></p>
       
              <a href=><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
<li class="active"><a href="conducteur.php"><i class="fa fa-linkedin-square"></i> <span>Tableau de bord</span></a></li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_information.php">Informations personnelles</a></li>
                <li><a href="conducteur_photo.php">Photo</a></li>
                <li><a href="conducteur_vehicule.php">Véhicule</a></li>
                <li><a href="conducteur_preference.php">Préférences</a></li>
              </ul>
            </li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_mot_passe.php">Mot de passe</a></li>
                <li><a href="conducteur_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li><a href="conducteur_annonce.php"><i class="fa fa-linkedin-square"></i> <span>Vos annonces</span></a></li>
            <li><a href="publier_annonce.php"><i class="fa fa-linkedin-square"></i> <span>Publier trajet</span></a></li>
          </ul>
        </section>
        
      </aside>

      <div class="content-wrapper">
       
        <section class="content-header">
          <h1>
            Tableau de bord
         
          </h1>
        </section>

        <section class="content" style="display: -webkit-flex;
    display: flex;-webkit-flex-wrap: wrap;
    flex-wrap: wrap;margin-top:10px; background-image:url(images/profil_back1.png);
     background-repeat:no-repeat; background-size:cover;color:white;padding:20px;border-radius:5px;">
        
        <div style="margin-right:50px;margin-left:100px;padding:15px;border:1px solid;border-radius:5px;width:30%;">
         
        <div id="lien" style="border-bottom:1px solid;padding-bottom:10px;">
        <div style="margin-bottom:8px;">
        <strong style="font-size:23px;" >Préférences </strong><br>
        <?php if(substr($cond->preference(),0,2)=="OF"){echo '<img src="images/yes-smoking-1560x2206.png" height="45px" width="45px" />';}
		elseif(substr($cond->preference(),0,2)=="NF") {echo '<img src="images/No_smoking_symbol.svg.png" height="45px" width="45px"/>';}?>
        
        <?php if(substr($cond->preference(),2,2)=="OM"){echo '<img src="images/music_icon_red_opt.svg" height="45px" width="45px"/>';}
		elseif(substr($cond->preference(),2,2)=="NM") {echo '<img src="images/no-music-md.png" height="45px" width="45px"/>';}?>
        
        <?php if(substr($cond->preference(),4,2)=="OA"){echo '<img src="images/petit-chien-accepte.png" height="45px" width="45px"/>';}
		elseif(substr($cond->preference(),4,2)=="NA") {echo '<img src="images/chien_interdit.gif" height="45px" width="45px"/>';}?>
		</div>
        <a  href="conducteur_preference.php" style="font-size:16px;"><i class="fa fa-arrow-right"></i> Modifier vos préférences</a><br>
       
        
        </div>
        <div style="border-bottom:1px solid;padding-bottom:10px;">
        <div style="margin-bottom:8px;">
        <strong style="font-size:23px;" >Activité </strong><br>
		</div>
        <span style="margin-bottom:5px;font-size:16px;">Annonce publiée : <?php echo $managert->countt($cond->id());  ?></span><br>
        <span style="margin-bottom:5px;font-size:16px;">Date d'inscription : <?php echo $cond->date_inscription();?></span>
        </div>
        <div>
        <div style="margin-bottom:8px;">
        <strong style="font-size:23px;padding-bottom:10px;" >Véhicule </strong><br>
		</div>
        <?php if($voiture[0]->photo()!=""){echo '<img src="profil_photo/'.$voiture[0]->photo().'" style="display: block;
    border: 4px double #E6E6E6;margin-bottom:10px;"/>';} else {echo '
        <img src="images/car.png" style="display: block;
    border: 4px double #E6E6E6;margin-bottom:10px;"/>';}?>
        <span style="margin-bottom:5px;font-size:16px;"><?php echo $voiture[0]->marque(); ?></span><br>
        <span style="margin-bottom:5px;font-size:16px;">Couleur : <?php echo ucfirst($voiture[0]->couleur()); ?></span>
        
        </div>
        </div>
        <div style="display: -webkit-flex;
    display: flex;border:1px solid #F2F2F2;height:140px;padding:10px 10px 10px 15px;border-radius:5px;width:50%;
    background-color:#F2F2F2;color:black;">
        <img src="profil_photo/<?php echo $cond->photo();?>" style="border-radius:100%;" height="100px" /><br>

        <div style="margin-left:50px;">
        
        <strong style="font-size:23px;">Bonjour <?php echo ucfirst($cond->prenom());?></strong><br>
<small style="font-size:16px;">(<?php echo age($cond->date_naissance());?> ans)</small><br>
<a href="conducteur_information.php" style="font-size:16px;"><i class="fa fa-arrow-right"></i> Modifier votre profil</a><br>

        </div>
        
        </div>
        <img src="images/nassim.png" height="200px" width="600px;" style="margin-top:-30px;margin-left:200px;"/>
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
