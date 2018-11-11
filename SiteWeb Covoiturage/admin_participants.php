<?php 
session_start();
//appel des classes
require_once ('dbconfig.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
$manager=new ParticipantManager();
//la liste des tous les participants
$parts=$manager->getlist();
?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Participants | EtuCovoiturage</title>

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


  </head>


  <body class="hold-transition skin-green sidebar-mini">
    <div class="wrapper">
<!-- tête principal -->
      <header class="main-header">
<!-- Logo -->

        <a href="admin.php" class="logo">
<!-- Mini logo  -->
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
            
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  
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
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">

            <li class=" treeview"><a href="#"><i class="fa fa-link"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="admin_email.php">E-mail</a></li>
                <li><a href="admin_mot_passe.php">Mot de passe</a></li>
              </ul>
            </li>
            <li><a href="admin_villes.php"><i class="fa fa-link"></i> <span>Villes</span></a></li>
            <li class="active">
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

        <section class="content-header">
          <h1>
            Liste participants
          </h1>
        </section>


        <section class="content">
<!-- Tableau contient la liste de tout les participants -->
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>ID_participant</th>
        <th>Nom_participant</th>
        <th>Prenom_participant</th>
        <th>Sexe</th>
        <th>Date_naissance</th>
        <th>Numeèro teléphone</th>
        <th>Consulter_Participant</th>
        
      </tr>
    </thead>
    <tbody>
    <?php 
foreach ($parts as $part)
{
echo '<tr>' ;
echo '<td>',$part->id(),'</td>';
echo '<td>',$part->nom(),'</td>';
echo '<td>',$part->prenom(),'</td>';
echo '<td>',$part->sexe(),'</td>';
echo '<td>',$part->date_naissance(),'</td>';
echo '<td>',$part->tel(),'</td>';
echo '<td style="text-align:center;"><a href="profil_participant.php?id='.$part->id().'"><i style="color:blue;cursor:pointer;" class="fa fa-forward"></a></i></td>';
echo '</tr>';
}

?>
    </tbody>
  </table>
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
