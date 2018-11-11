<?php 
session_start();
//appel des classes
require_once ('dbconfig.php');
require_once ('Administrateurmanager.class.php');
require_once ('Administrateur.class.php');
$manager=new AdministrateurManager();
//recuperer identifiant admin
$id=$_SESSION['user_admin'];
$admin=$manager->get($id);
//modification les informations
if(isset($_POST['bouton_modifier']))
{		if($_POST['passe']==$admin->mp())
		{		if($_POST['passe1']==$_POST['passe2'])
				{		if($manager->modifier($admin))
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
    <title>Mot de passe | EtuCocoiturage</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
<!-- Bootstrap 3.5 -->
    <link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="icon" type="images/png" href="images/title.gif"/>
<!-- Font awesome -->
        <link rel="stylesheet" href="font-awesome-4.6.1/css/font-awesome.min.css">
<!-- Ionicons -->
    <link rel="stylesheet" href="css/ionicons.min.css">
<!-- Theme style -->
    <link rel="stylesheet" href="css/profil.min.css">

    <link rel="stylesheet" href="css/_all-skins.min.css">


  </head>


  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
<!-- tête principal -->
      <header class="main-header">

<!-- Logo -->
        <a href="admin.php" class="logo">
<!-- Mini logo -->
          <span class="logo-mini"><b>EC</b></span>
 
          <span class="logo-lg"><b>E</b>tu<b>C</b>ovoiturage</span>
        </a>

<!-- barre navigation -->
        <nav class="navbar navbar-static-top" role="navigation">
   
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
          </a>

          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">

         <!-- compte admin -->
              <li class="dropdown user user-menu">
            
                <a href="" class="dropdown-toggle" data-toggle="dropdown">
                  
                  <img src="images/leadership-avatar-m-560x450.jpg" class="user-image" alt="User Image">
                  <span class="hidden-xs">Administrateur</span>
                </a>
                <ul class="dropdown-menu">
                  <li class="user-header">
                    <img src="images/leadership-avatar-m-560x450.jpg" class="img-circle" alt="User Image">
                    <p>
                      Administrateur
                      
                    </p>
                  </li>
                  <li class="user-footer">
                    <div class="pull-left">
                      <a href="admin_email.php" class="btn btn-default btn-flat">Profil</a>
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
              <p>Administrateur</p>
              <a ><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">

            <li class="active treeview"><a href="#"><i class="fa fa-link"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="admin_email.php">E-mail</a></li>
                <li><a href="admin_mot_passe.php">Mot de passe</a></li>
              </ul>
            </li>
            <li><a href="admin_villes.php"><i class="fa fa-link"></i> <span>Villes</span></a></li>
            <li>
              <a href="admin_participants.php"><i class="fa fa-link"></i> <span>Liste des participants</span></a>
            </li>
            <li>
              <a href="admin_conducteurs.php"><i class="fa fa-link"></i> <span>Liste des conducteurs</span></a>
            </li>
            <li>
              <a href="admin_trajets.php"><i class="fa fa-link"></i> <span>Liste des trajets</span></a>
            </li>
          </ul>
        </section>

      </aside>

    
      <div class="content-wrapper">

        <section class="content-header" style="margin-left:200px;margin-bottom:20px;">
          <h1>
            Mot de passe
          </h1>
        </section>
        <!-- section pour le cas de succés de modification où erreur -->
 <?php if(isset($_SESSION['mot'])&& $_SESSION['mot']==1){$_SESSION['mot']=""; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre mot de passe est modifié !!</div>';}
		elseif(isset($_SESSION['mot'])&& $_SESSION['mot']==2){$_SESSION['mot']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Vérifier votre ancien mot de passe !!</div>';}
		elseif(isset($_SESSION['mot'])&& $_SESSION['mot']==3){$_SESSION['mot']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Vérifier votre nouveau mot de passe !!</div>';} ?>
<style>
.content input[type="password"]
{width:50%;}
</style>
        <section class="content" style="width:80%;margin-right:200px;">
       <!-- form modification --> 
<form method="post" action="admin_mot_passe.php" class="form-horizontal" role="form">
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
      <button type="submit" name="bouton_modifier" style="color:white;" class="btn btn-default btn-primary">Enregistrer</button>
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
