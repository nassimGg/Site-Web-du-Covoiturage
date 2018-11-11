<?php 
session_start();
//appel les classes
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
$manager=new ParticipantManager();
$manager1=new ConducteurManager();
$trajet=new TrajetManager();
$trajets=$trajet->getlist();
$parts=$manager->getlist();
$conds=$manager1->getlist();
$id=$_SESSION['user_cond'];
$cond=$manager1->get($id);
//modifier photo de profil
if(isset($_POST['bouton_photo']))
{
if(is_uploaded_file($_FILES['image']['tmp_name'])){ 
    $folder = "profil_photo/"; 
    $file = basename( $_FILES['image']['name']); 
    $full_path = $folder.$file; 
    move_uploaded_file($_FILES['image']['tmp_name'], $full_path);}
$cond->setPhoto($file);
if($manager1->modifier($cond))
{$succes="1";
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
   
    <link rel="stylesheet" href="css/bootstrap.min.css">

    <link rel="icon" type="images/png" href="images/title.gif"/>

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
                  
                  <span class="hidden-xs"></span><?php echo ucfirst($cond->prenom());?>
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
                      <a href="conducteur_information.php"class="btn btn-default btn-flat">Profil</a>
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
            <li class="active treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_information.php">Informations personnelles</a></li>
                <li><a href="conducteur_photo.php">Photo</a></li>
                <li><a href="conducteur_vehicule.php">Véhicule</a></li>
                <li><a href="conducteur_preference.php">Préférences</a></li>
              </ul>
            </li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_mot_passe.php">Mot de passe</a></li>
                <li><a href="conducteur_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li><a href="conducteur_annonce.php"><i class="fa fa-linkedin"></i> <span>Vos annonces</span></a></li>
            <li><a href="publier_annonce.php"><i class="fa fa- fa-linkedin"></i> <span>Publier trajet</span></a></li>
          </ul>
        </section>

      </aside>

     
      <div class="content-wrapper">

        <section class="content-header">
          <h1>
            Photo
 
          </h1>
        </section>

        <section class="content" style="display: -webkit-flex;
    display: flex;margin-left:200px; background-image:url(images/connexion.png);background-repeat:no-repeat;border-radius:5px;color:white;width:600px;">
       
<form action="conducteur_photo.php"  method="post" class="form-horizontal"  enctype="multipart/form-data">
    <img src="<?php if($cond->photo()!=""){echo 'profil_photo/'.$cond->photo();}else{ echo 'images/53308.png';}?>" width="120px" height="150px" style="margin-left:60px;border-radius:100%;" style="border-radius:100%;"/><br>
    <span style="margin-left:50px;margin-top:30px;font-size:20px;"><?php if($cond->photo()!=""){echo 'Modifier votre photo';}else {echo 'Ajouter une photo';}?></span><br>
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
