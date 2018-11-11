<?php 
session_start();
//appel les classes
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');

$manager1=new ConducteurManager();

$id=$_SESSION['user_cond'];
$cond=$manager1->get($id);
//modification mot de passe
if(isset($_POST['bouton_modifier']))
{		if($_POST['passe']==$cond->mp())
		{		if($_POST['passe1']==$_POST['passe2'])
				{		if($manager1->modifier($cond))
						{$_SESSION['mot']=1;
						}
				}
				else
				{
					$_SESSION['mot']=3;
				}
		}
		else
		{
			$_SESSION['mot']=2;
		}
}


?>




<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mot de passe | EtuCovoiturage</title>
    <link rel="icon" type="images/png" href="images/title.gif"/>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
 
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
              <img src="images/leadership-avatar-m-560x450.jpg" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($cond->prenom());?></p>

              <a ><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li><a href="conducteur.php"><i class="fa fa-linkedin"></i> <span>Tableau de bord</span></a></li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_information.php">Informations personnelles</a></li>
                <li><a href="conducteur_photo.php">Photo</a></li>
                <li><a href="conducteur_vehicule.php">Véhicule</a></li>
                <li><a href="conducteur_preference.php">Préférences</a></li>
              </ul>
            </li>
            <li class="active treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_mot_passe.php">Mot de passe</a></li>
                <li><a href="conducteur_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li><a href="conducteur_annonce.php"><i class="fa fa-linkedin"></i> <span>Vos annonces</span></a></li>
            <li><a href="publier_annonce.php"><i class="fa fa-linkedin"></i> <span>Publier trajet</span></a></li>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">
      
        <section class="content-header" style="margin-left:200px;margin-bottom:20px;">
          <h1>
            Mot de passe

          </h1>
        </section>
        <?php if(isset($_SESSION['mot'])&& $_SESSION['mot']==1){$_SESSION['mot']=''; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre mot de passe est modifié !!</div>';}
		elseif(isset($_SESSION['mot'])&& $_SESSION['mot']==2){$_SESSION['mot']='';echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Vérifier votre ancien mot de passe !!</div>';}
		elseif(isset($_SESSION['mot'])&& $_SESSION['mot']==3){$_SESSION['mot']='';echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Vérifier votre nouveau mot de passe !!</div>';} ?>
<style>
.content input[type="password"]
{width:50%;}
</style>
        <section class="content" style="width:80%;margin-right:200px;">
        
<form method="post" action="conducteur_mot_passe.php" class="form-horizontal" role="form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwda">Actuel :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input type="password" name="passe" required class="form-control" id="pwda"  placeholder="Entrez mot de passe"><span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="pwd">Nouveau mot de passe:</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="password" name="passe1" required class="form-control" id="pwd"  placeholder="Entrez nouveau mot de passe"><span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="pwdd">Confirmez le nouveau :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="password" name="passe2" required class="form-control" id="pwdd" placeholder="Retapez le nouveau"><span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="bouton_modifier" class="btn btn-default">Enregistrer</button>
    </div>
  </div>
</form>
<div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10" style="font-size:18px;display: -webkit-flex;
    display: flex; ">
      <span style="color:red;font-size:25px;margin-right:7px;">*</span> Champs obligatoires.
    </div>
  </div>
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
