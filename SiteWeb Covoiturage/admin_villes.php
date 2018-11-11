<?php 
session_start();
//appel des classes
require_once ('dbconfig.php');
require_once ('Administrateurmanager.class.php');
require_once ('Administrateur.class.php');
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');

$managerville=new VilleManager();
$manager=new AdministrateurManager();
//recuperer la liste des villes
$villes=$managerville->villelist();
//pour chaque ville tester si le bouton modifier ou supprimer correspond a elle
foreach($villes as $ville)
{if(isset($_POST['bouton_modifier'.$ville->num_ville().'']))
{
	$nomville=$_POST['ville'.$ville->num_ville().''];
	if($managerville->modifier($ville))
	{$_SESSION['mod_ville']=1;
	}
}
if(isset($_POST['bouton_supp'.$ville->num_ville().'']))
{
	$nomville=$_POST['ville'.$ville->num_ville().''];
	if($managerville->delete($ville))
	{$_SESSION['supp_ville']=1;
	}
}
	
}
//ajouter une ville
if(isset($_POST['bouton_ajouter']))
{$nom=$_POST['villea'];
$newville=new Ville(array('nom_ville'=>$nom));
if($managerville->add($ville))
{$_SESSION['ajouter_ville']=1;
}
	
	
	
}


?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Villes | EtuCovoiturage</title>

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
<!-- Mini logo -->
          <span class="logo-mini"><b>EC</b></span>
 
          <span class="logo-lg"><b>E</b>tu<b>C</b>ovoiturage</span>
        </a>

<!-- Barre navigation -->
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
            <li class="active"><a href="admin_villes.php"><i class="fa fa-link"></i> <span>Villes</span></a></li>
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

        <section class="content-header">
          <h1>
            Liste trajets
            
          </h1>
        </section>


        <section class="content">
        <!-- Form ajouter une nouvelle ville -->
        <div id="ajouter_ville" hidden="true">
  <form action="admin_villes.php" method="post" class="form-horizontal" role="form">
<div class="form-group">
    <label class="control-label col-sm-2" for="ville">Nom ville :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input id="ville" list="villes" style="width:30%;padding-left:30px;font-size:16px;" required name="villea" type="text"  placeholder="Entrez nom de la ville" >
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" style="color:white;" name="bouton_ajouter" class="btn btn-default btn-primary">Enregistrer</button>
    </div>
  </div>
</form>
<div class="col-sm-12">
<button  class="btn btn-default btn-primary" style="color:white;position:relative;top:-49px;left:340px;" onClick="retour()"> Retour</button>
</div>
</div>
 
 <script>
 function show_ajout()
 {document.getElementById("b_content").style.display="none";
 document.getElementById("ajouter_ville").style.display="block";
 <?php foreach($villes as $ville)
 {echo 'document.getElementById("'.$ville->num_ville().'").style.display="none";';
 }?>
	 
 }
 </script>       
        <!-- section pour affichage le message pour le cas d'ajout , modifier où supprimer une ville -->
<div id="b_content" style="text-align:center;">
 <?php if(isset($_SESSION['mod_ville'])&& $_SESSION['mod_ville']==1){$_SESSION['mod_ville']=""; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre ville est modifié !!</div>';}
		elseif(isset($_SESSION['supp_ville'])&& $_SESSION['supp_ville']==1){$_SESSION['supp_ville']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre ville est supprimée !!</div>';}
		elseif(isset($_SESSION['ajouter_ville'])&& $_SESSION['ajouter_ville']==1){$_SESSION['ajouter_ville']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre ville est ajouté avec succées !!</div>';} ?>

<div style="margin-bottom:20px;">
<button class="btn btn-default btn-primary" style="color:white;width:20%;" onClick="show_ajout()">Ajouter une ville</button>
</div>
<!-- Tableau contient la liste des villes -->
  <table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Numéro Ville</th>
        <th>Nom Ville</th>
        <th></th>
      </tr>
    </thead>
    <tbody>
    <?php
foreach ($villes as $ville)
{
echo '<tr>' ;
echo '<td>',$ville->num_ville(),'</td>';
echo '<td>',utf8_encode($ville->nom_ville()),'</td>';
echo '<td><i class="fa fa-pencil" onClick="show_edit'.$ville->num_ville().'()" style="cursor:pointer;color:#00CC66;margin-right:20px;"></i><i class="fa fa-remove" onclick="showDialog'.$ville->num_ville().'()" style="cursor:pointer;color:#ffc4c4;"></i></td>';
echo '</tr>';
echo '<script>
		function show_edit'.$ville->num_ville().'()
		{document.getElementById("edit_ville'.$ville->num_ville().'").style.display="block";
		 document.getElementById("b_content").style.display="none";
		}
         </script>';
}
?>
    </tbody>
  </table>
  </div>
  <?php 
foreach($villes as $ville)
{echo'
	   <div id="white-background'.$ville->num_ville().'">
</div>
<div id="dlgbox'.$ville->num_ville().'">
    <div id="dlg-header">Confirmation</div>
    <div id="dlg-body">Vous voulez vraiment supprimer la ville '.utf8_encode($ville->nom_ville()).' ?</div>
    <div id="dlg-footer" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="admin_villes.php" style=" margin-left:280px;">
	<input type="text" hidden="true" value="'.$ville->num_ville().'" name="ville'.$ville->num_ville().'">
        <button type="submit" style="width:50px;" name="bouton_supp'.$ville->num_ville().'" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHide'.$ville->num_ville().'()">Annuler</button>
    </div>
</div>
	
<style>
        #white-background'.$ville->num_ville().'{
            display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.7;
            z-index: 9999;
        }

        #dlgbox'.$ville->num_ville().'{
            /*initially dialog box is hidden*/
            display: none;
            position: fixed;
            width: 480px;
            z-index: 9999;
            border-radius: 10px;
            background-color: #7c7d7e;
        }

        #dlg-header{
            background-color: #6d84b4;
            color: white;
            font-size: 20px;
            padding: 10px;
            margin: 10px 10px 0 10px;
        }

        #dlg-body{
            background-color: white;
            color: black;
            font-size: 14px;
            padding: 10px;
            margin: 0 10px 0 10px;
        }

        #dlg-footer{
            background-color: #f2f2f2;
            text-align: right;
            padding: 10px;
			
            margin: 0 10px 10px 10px;
        }

        #dlg-footer button{
            background-color: #6d84b4;
            color: white;
            padding: 5px;
			width:80px;
			border-radius:5px;
            border: 0;
        }
    </style>
	<script>
	function dlgHide'.$ville->num_ville().'(){
        var whitebg = document.getElementById("white-background'.$ville->num_ville().'");
        var dlg = document.getElementById("dlgbox'.$ville->num_ville().'");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }
	function showDialog'.$ville->num_ville().'(){
        var whitebg = document.getElementById("white-background'.$ville->num_ville().'");
        var dlg = document.getElementById("dlgbox'.$ville->num_ville().'");
        whitebg.style.display = "block";
        dlg.style.display = "block";

        var winWidth = window.innerWidth;

        dlg.style.left = (winWidth/2) - 480/2 + "px";
        dlg.style.top = "150px";
    }
	</script>';}
?>  
  </div>

<?php
 foreach($villes as $ville)
  {echo '
  <div id="edit_ville'.$ville->num_ville().'" hidden="true" style="position:relative;top:-400px;left:200px;">
  <form action="admin_villes.php" method="post" class="form-horizontal" role="form">
<div class="form-group">
    <label class="control-label col-sm-2" for="ville">Nom ville :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input id="ville"  style="width:30%;padding-left:30px;font-size:16px;" required value="'.utf8_encode($ville->nom_ville()).'" name="ville'.$ville->num_ville().'" type="text"  placeholder="Entrez nom de la ville" >
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group" hidden="true">
    <label class="control-label col-sm-2" for="numville">Num ville :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input id="numville"  style="width:30%;padding-left:30px;font-size:16px;" value="'.$ville->num_ville().'" required name="num_ville'.$ville->num_ville().'" type="text">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>

  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" style="color:white;" name="bouton_modifier'.$ville->num_ville().'" class="btn btn-default btn-primary">Enregistrer</button>
    </div>
  </div>
</form>
<div class="col-sm-12">
<button  class="btn btn-default btn-primary" style="color:white;position:relative;top:-49px;left:340px;" onClick="retour()"> Retour</button>
</div>
</div>';}
echo'
<script>
function retour(){
';foreach($villes as $ville)
{echo 'document.getElementById("edit_ville'.$ville->num_ville().'").style.display="none";
		 ';}
echo'document.getElementById("b_content").style.display="block";
document.getElementById("ajouter_ville").style.display="none";}
</script>';?>
        </section>
      </div>

 
      <footer  class="main-footer">
 
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
