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
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Reservation.class.php');
$manager=new ParticipantManager();
$id=$_SESSION['user_part'];
$part=$manager->get($id);
$reserv=new Reservation();
$reservation=$reserv->get($id);


?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Tableau de bord | EtuCovoiturage</title>
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

              <a ><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
           <li class="active"><a href="participant.php"><i class="fa fa- fa-linkedin-square"></i> <span>Tableau de bord</span></a></li>
            <li class=" treeview"><a><i class="fa fa-linkedin-square"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="participant_information.php">Informations personnelles</a></li>
                <li><a href="participant_photo.php">Photo</a></li>
              </ul>
            </li>
            <li class=" treeview"><a><i class="fa fa-linkedin-square"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
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
           Tableau de bord
            
          </h1>
        </section>

        <section class="content" style="display: -webkit-flex;
    display: flex;-webkit-flex-wrap: wrap;
    flex-wrap: wrap;margin-top:10px; background-image:url(images/profil_back.png);
     background-repeat:no-repeat; background-size:cover;color:white;padding:20px;border-radius:5px;">
        
        <div style="margin-right:50px;margin-left:100px;padding:10px;border:1px solid;border-radius:5px;width:30%;">
         
        
        <strong style="font-size:23px;" >Activité </strong><br><br>

        <span style="margin-bottom:5px;font-size:16px;">Nombre réservation : <?php echo $reserv->countr($part->id());?></span><br><br>
        <span style="margin-bottom:5px;font-size:16px;">Date d'inscription : <?php echo $part->date_inscription();?></span>
        
        </div>
        <div style="display: -webkit-flex;
    display: flex;border:1px solid #F2F2F2;height:140px;padding:10px 10px 10px 15px;border-radius:5px;width:50%;
    background-color:#F2F2F2;color:black;">
        <img src="profil_photo/<?php echo $part->photo();?>" style="border-radius:100%;" height="100px" /><br>

        <div style="margin-left:50px;">
        
        <strong style="font-size:23px;">Bonjour <?php echo ucfirst($part->prenom());?></strong><br>
<small style="font-size:16px;">(<?php echo age($part->date_naissance());?> ans)</small><br>
<a href="participant_information.php" style="font-size:16px;"><i class="fa fa-arrow-right"></i> Modifier votre profil</a><br>

        </div>
        
        </div>
        <img src="images/nassim.png" height="200px" width="600px;" style="margin-top:20px;margin-left:200px;"/>
        </section>
      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs">
          EtuCovoiturage
        </div>

        <strong>Covoiturage,2016 &copy; </strong>
      </footer>

    </div>
  <script src="js/jQuery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/app.min.js"></script>


  </body>
</html>
