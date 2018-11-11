<?php 
session_start();
//appel les classes
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');

$manager1=new ConducteurManager();

$id=$_SESSION['user_cond'];
$cond=$manager1->get($id);
//modification les preferences
if(isset($_POST['bouton_modifier']))
{$cigarette=$_POST['cigarette'];
$music=$_POST['music'];
$annimaux=$_POST['annimaux'];
$cond->setPreference($_POST['cigarette'].$_POST['music'].$_POST['annimaux']);
if($manager1->modifier($cond))
			{$_SESSION['pref_m']=1;
			}
		
	
	
}
?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Préférence | EtuCovoiturage</title>
    <link rel="icon" type="images/png" href="images/title.gif"/>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 <link rel="icon" type="images/png" href="images/title.gif"/>
    <link rel="stylesheet" href="css/bootstrap.min.css">

        <link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">

    <link rel="stylesheet" href="css/ionicons.min.css">

    <link rel="stylesheet" href="css/profil.min.css">

    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">

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
  
              <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
   			<li><a href="conducteur.php"><i class="fa fa- fa-linkedin"></i> <span>Tableau de bord</span></a></li>
            <li class=" active treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_information.php">Informations personnelles</a></li>
                <li><a href="conducteur_photo.php">Photo</a></li>
                <li><a href="conducteur_vehicule.php">Véhicule</a></li>
                <li><a style="color:white;" href="conducteur_preference.php">Préférences</a></li>
              </ul>
            </li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_mot_passe.php">Mot de passe</a></li>
                <li><a href="conducteur_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li><a href="conducteur_annonce.php"><i class="fa fa- fa-linkedin"></i> <span>Vos annonces</span></a></li>
            <li><a href="publier_annonce.php"><i class="fa fa-linkedin"></i> <span>Publier trajet</span></a></li>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">

        <section class="content-header" style="margin-left:200px;margin-bottom:20px;">
          <h1>
            Préférence

          </h1>
        </section>
        <?php if(isset($_SESSION['pref_m'])&& $_SESSION['pref_m']==1){$_SESSION['pref_m']=''; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Vos préférences est modifié !!</div>';}
		 ?>


<style>
.content input
{width:50%;}
</style>
        <section class="content" style="width:80%;margin-right:200px;">
        <form method="post" action="conducteur_preference.php" class="form-horizontal" role="form">
        
<div class="form-group">
    <label class="control-label col-sm-2" for="cigarette">Cigarette :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <select name="cigarette" style="width:50%;" class="form-control" required id="cigarette" >
      <option <?php if(substr($cond->preference(),0,2)=="OF") {echo 'selected';}?>value="OF">Ça ne me dérange pas</option>
      <option <?php if(substr($cond->preference(),0,2)=="NF") {echo 'selected';}?> value="NF">Ça me dérange</option>
      </select>
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="music">Music :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
<select name="music" style="width:50%;" class="form-control" required id="music" >
      <option <?php if(substr($cond->preference(),2,2)=="OM") {echo 'selected';}?> value="OM">Ça ne me dérange pas</option>
      <option <?php if(substr($cond->preference(),2,2)=="NM") {echo 'selected';}?> value="NM">Ça me dérange</option>
      </select>
         <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="annimaux">Annimaux :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
<select name="annimaux" style="width:50%;" class="form-control" required id="annimaux" >
      <option <?php if(substr($cond->preference(),4,2)=="OA") {echo 'selected';}?> value="OA">Ça ne me dérange pas</option>
      <option <?php if(substr($cond->preference(),4,2)=="NA") {echo 'selected';}?> value="NA">Ça me dérange</option>
      </select>  
        <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="bouton_modifier" style="background-color:#3c8dbc;color:white;" class="btn btn-default">Enregistrer</button>
    </div>
  </div>
</form>
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
