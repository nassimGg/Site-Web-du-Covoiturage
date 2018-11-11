<?php 
session_start();
//appel les classes
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');

$manager1=new ConducteurManager();

$id=$_SESSION['user_cond'];
$cond=$manager1->get($id);
//fermeture compte
if(isset($_POST['bouton_fermer']))
{
	if($manager1->delete($id))
	{$manager1->redirect('index2.php');}
}


?>


<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Fermeture compte | EtuCovoiturage</title>
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
              <img src="profil_photo/<?php echo $cond->photo();?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($cond->prenom());?></p>
 
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">

<li><a href="conducteur.php"><i class="fa fa-linkedin"></i> <span>Tableau de bord</span></a></li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_information.php">Informations personnelles</a></li>
                <li><a href="conducteur_photo.php">Photo</a></li>
                <li><a href="conducteur_vehicule.php">Véhicule</a></li>
                <li><a href="conducteur_prefrence.php">Préférences</a></li>
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

   <style>
.content input
{width:50%;}
</style>
      <div class="content-wrapper">
    
        <section class="content-header" style="margin-left:200px;margin-bottom:20px;">
          <h1>
            Fermer mon compte
          </h1>
        </section>
        

        <section class="content" style="width:80%;margin-right:200px;">
        
<form method="post" action="conducteur_fermer_compte.php" class="form-horizontal" role="form">
  <div class="form-group">
    <label class="control-label col-sm-2" for="rasion">Raison :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
<select class="form-control" id="raison" required>
															<option>Choisissez</option>
															<option>Aucun problème, le site est top</option>
															<option>J'ai déménagé et ne fais plus de covoiturage</option>
															<option>Je n'ai pas trouvé ce que je cherchais, et je ne vois pas l'utilité de rester inscrit(e)</option>
															<option>J'ai rencontré un problème technique bloquant</option>
															<option>J'ai un autre compte et je souhaite supprimer celui-ci</option>
															<option>Je croyais vouloir faire du covoiturage, mais finalement ce n'est pas mon truc</option>
															<option>Autre raison</option>
														</select><span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
                                                            </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="ameliorer">Que pourions-nous améliorer ?</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
 <textarea id="ameliorer" class="form-control" style="width: 440px;
min-height: 82px;
overflow: auto;border-radius:5px;margin-top:10px;
resize: none;" required></textarea><span style="margin-left:7px;color:red;font-size:25px;margin-top:40px;">*</span>
</div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <i onclick="showDialog()" style="cursor:pointer;color:white;" class="btn btn-default btn-primary">Fermer mon compte</i>
    </div>
    </div>
</form>
 
  <div id="white-background">
</div>
<div id="dlgbox">
    <div id="dlg-header">Confirmation</div>
    <div id="dlg-body">Vous voulez vraiment fermer votre compte ?</div>
    <div id="dlg-footer" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="conducteur_fermer_compte.php" style=" margin-left:280px;">
	<input type="text" hidden="true" value="'.$trajet->num_trajet().'" name="raison">
        <button type="submit" style="width:50px;" name="bouton_fermer" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHide()">Annuler</button>
    </div>
</div>
	
<style>
        #white-background{
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

        #dlgbox{
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
	function dlgHide(){
        var whitebg = document.getElementById("white-background");
        var dlg = document.getElementById("dlgbox");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }
	function showDialog(){
        var whitebg = document.getElementById("white-background");
        var dlg = document.getElementById("dlgbox");
        whitebg.style.display = "block";
        dlg.style.display = "block";

        var winWidth = window.innerWidth;

        dlg.style.left = (winWidth/2) - 480/2 + "px";
        dlg.style.top = "150px";
    }
	</script>
        </section>
      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs">
          EtuCovoiturage
        </div>
        
        <strong>Covoiturage,2016 &copy; .</strong>
      </footer>


    </div>
<script src="js/jQuery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/app.min.js"></script>
    

  </body>
</html>
