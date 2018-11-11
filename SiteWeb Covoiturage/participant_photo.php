<?php 
session_start();
//appel des classes
require_once ('dbconfig.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
$manager=new ParticipantManager();
//recuperer identifiant de participant
$id=$_SESSION['user_part'];
$part=$manager->get($id);
//modifier image de profil
if(isset($_POST['bouton_photo']))
{
if(is_uploaded_file($_FILES['image']['tmp_name'])){ 
    $folder = "profil_photo/"; 
    $file = basename( $_FILES['image']['name']); 
    $full_path = $folder.$file; 
    move_uploaded_file($_FILES['image']['tmp_name'], $full_path);}
$part->setPhoto($file);
if($manager->modifier($part))
{$_SESSION['mod_photo']=1;
}
}
?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Photo | EtuCovoiturage</title>
  
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
    <!-- Calendrier datepicker -->
    <link href="jQueryAssets/jquery.ui.core.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.theme.min.css" rel="stylesheet" type="text/css">
    <link href="jQueryAssets/jquery.ui.datepicker.min.css" rel="stylesheet" type="text/css">
  <script src="jQueryAssets/jquery-1.8.3.min.js" type="text/javascript"></script>
  <script src="jQueryAssets/jquery-ui-1.9.2.datepicker.custom.min.js" type="text/javascript"></script>
  </head>
 
  <body class="hold-transition skin-purple sidebar-mini">
    <div class="wrapper">
<!-- tête principal -->
      <header class="main-header">
      <!-- Logo -->
        <a href="index_profil_passager.php" class="logo">
        <!-- Mini logo -->
          <span class="logo-mini"><b>EC</b></span>

          <span class="logo-lg"><b>E</b>tu<b>C</b>ovoiturage</span>
        </a>

        <nav class="navbar navbar-static-top" role="navigation">

          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only"></span>
          </a>
<!-- barre navigation -->
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
<!-- compte participant -->
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
              <a ><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
            <li><a href="participant.php"><i class="fa fa-linkedin-square"></i> <span>Tableau de bord</span></a></li>
            <li class="active" class=" treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="participant_information.php">Informations personnelles</a></li>
                <li><a href="participant_photo.php">Photo</a></li>
              </ul>
            </li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
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
  
        <section class="content-header">
          <h1>
            Photo
 
          </h1>
        </section>
        <!-- section pour le cas de modification du photo -->
        <?php if(isset($_SESSION['mod_photo'])&& $_SESSION['mod_photo']==1){$_SESSION['mod_photo']=""; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#605ca8;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre photo est modifié !!</div>';}
		?>


       <section class="content" style="display: -webkit-flex;
    display: flex;margin-left:200px; background-image:url(images/connexion.png);background-repeat:no-repeat;border-radius:5px;color:white;width:600px;">
       <!-- form de modification du photo -->
<form action="participant_photo.php"  method="post" class="form-horizontal"  enctype="multipart/form-data">
    <img src="<?php if($part->photo()!=""){echo 'profil_photo/'.$part->photo();}else{ echo 'images/53308.png';}?>" width="120px" height="150px" style="margin-left:60px;border-radius:100%;" style="border-radius:100%;"/><br>
    <span style="margin-left:50px;margin-top:30px;font-size:20px;"><?php if($part->photo()!=""){echo 'Modifier votre photo';}else {echo 'Ajouter une photo';}?></span><br>
  <div style="position:relative; margin-left:70px;margin-top:20px;margin-bottom:20px;">
		<a class='btn btn-primary' href='javascript:;'>
			Choisir photo...
			<input type="file" style="position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);
            -ms-filter:'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)';opacity:0;
            background-color:transparent;color:transparent;" 
            name="image" size="40"  onchange="$('#upload-file-info').html($(this).val());"/>
		</a>
		&nbsp;
		<span class="label label-info" id="upload-file-info"></span>
        </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10" style="margin-left:50px;">
      <button type="submit" name="bouton_photo" style="width:150px;background-color:#36C;color:white;" class="btn btn-default">Enregistrer</button>
    </div>
    </div>
</form>
<div style="margin-left:100px;margin-top:50px;font-size:16px;">
<div style="display: -webkit-flex;
    display: flex;">
<img src="images/picture-upload-example-m.png" width="70px" height="50px" style="margin-top:10px;margin-left:5px;"/>
<p style="margin-left:20px;"> Exemple de<br> bonne photo</p>
</div>
<span style="color:#3FF">Comment choisir la bonne photo</span>
<ul style="list-style-type:circle">
<li>Pas de lunettes de soleil</li>
<li>Face a l'objectif </li>
<li>Un seul visage</li>
<li>Clair et lumineuse </li>
</ul>
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
