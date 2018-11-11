<?php 
session_start();
//appel les classes
require_once ('dbconfig.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');

$manager=new ParticipantManager();
//recuperer identifiant participant
$id=$_SESSION['user_part'];
$part=$manager->get($id);
//modification mot de passe 
if(isset($_POST['bouton_modifier']))
{		if($_POST['passe']==$part->mp())
		{		if($_POST['passe1']==$_POST['passe2'])
				{		if($manager->modifier($part))
						{$_SESSION['mot_p']=1;
						}
				}
				else
				{
					$_SESSION['mot_p']=3;
				}
		}
		else
		{
			$_SESSION['mot_p']=2;
		}
}


?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Mot de passe | EtuCovoiturage</title>
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="icon" type="images/png" href="images/title.gif"/>
<!-- Font awesome -->
        <link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">
<!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
<!-- Theme style -->
    <link rel="stylesheet" href="css/profil.min.css">
    <link rel="stylesheet" href="css/_all-skins.min.css">
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">


  <script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
  </head>
  
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">

      <header class="main-header">

        <a href="index_profil_passager.php" class="logo">

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
                
                  <img src="profil_photo/<?php echo $part->photo();?>" class="user-image" alt="User Image">
             
                  <span class="hidden-xs"><?php echo ucfirst($part->prenom());?></span>
                </a>
                <ul class="dropdown-menu">
               
                  <li class="user-header">
                    <img src="profil_photo/<?php echo $part->photo();?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo ucfirst($part->prenom()).' '.ucfirst($part->nom());?>
 
                    </p>
                  </li>

                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="participant_information.php" class="btn btn-default btn-flat">Profil</a>
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
              <img src="profil_photo/<?php echo $part->photo();?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($part->prenom());?></p>

              <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li><a href="participant.php"><i class="fa fa-linkedin-square"></i> <span>Tableau de bord</span></a></li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="participant_information.php">Informations personnelles</a></li>
                <li><a href="participant_photo.php">Photo</a></li>
              </ul>
            </li>
            <li class="active" class="treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="participant_mot_passe.php">Mot de passe</a></li>
                <li><a href="participant_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li><a href="participant_reservation.php"><i class="fa fa-linkedin-square"></i> <span>Vos réservations</span></a></li>
            <li><a href="recherche_covoiturage_participant.php"><i class="fa fa-linkedin-square"></i> <span>Rechercher covoiturage</span></a></li>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">

        <section class="content-header" style="margin-left:200px;margin-bottom:20px;">
          <h1>
            Mot de passe

          </h1>
        </section>
        <?php if(isset($_SESSION['mot_p'])&& $_SESSION['mot_p']==1){$_SESSION['mot_p']=''; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#605ca8;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre mot de passe est modifié !!</div>';}
		elseif(isset($_SESSION['mot_p'])&& $_SESSION['mot_p']==2){$_SESSION['mot_p']='';echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Vérifier votre ancien mot de passe !!</div>';}
		elseif(isset($_SESSION['mot_p'])&& $_SESSION['mot_p']==3){$_SESSION['mot_p']='';echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Vérifier votre nouveau mot de passe !!</div>';} ?>
<style>
.content input[type="password"]
{width:50%;}
</style>
        <section class="content" style="width:80%;margin-right:200px;">
        
<form method="post" action="participant_mot_passe.php" class="form-horizontal" role="form">
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
