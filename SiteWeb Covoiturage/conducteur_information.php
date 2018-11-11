<?php 
session_start();
//appel les classes 
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');

$manager1=new ConducteurManager();

$id=$_SESSION['user_cond'];
$cond=$manager1->get($id);
//modification les informations
if(isset($_POST['bouton_modifier']))
{$email=$_POST['email'];
$nom=$_POST['nom'];
$prenom=$_POST['prenom'];
$date=$_POST['date'];
$tel=$_POST['tel'];
	$stmt = $manager1->_db->prepare("SELECT * FROM Conducteur WHERE Email=:email");
			$stmt->execute(array(':email'=>$email));
			$row=$stmt->fetch(PDO::FETCH_ASSOC);
			
			if($row['Email']==$email && $row['ID_conducteur']!=$id) {
				$error = "Email existe !!";
			}
			else
			{$cond->setNom($nom);
			$cond->setPrenom($prenom);
			$cond->setDate_naissance($date);
			$cond->setEmail($email);
			$cond->setTel($tel);
			if($manager1->modifier($cond))
			{$_SESSION['inf']=1;
			}
			}
	
	
}
?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Informations | EtuCovoiturage</title>
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
            <li><a href="conducteur_annonce.php"><i class="fa fa- fa-linkedin"></i> <span>Vos annonces</span></a></li>
            <li><a href="publier_annonce.php"><i class="fa fa-linkedin"></i> <span>Publier trajet</span></a></li>
          </ul>
        </section>

      </aside>

      <div class="content-wrapper">

        <section class="content-header" style="margin-left:200px;margin-bottom:20px;">
          <h1>
            Informations personnelles

          </h1>
        </section>
        <?php if(isset($_SESSION['inf'])&& $_SESSION['inf']==1){$_SESSION['inf']=''; echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Vos informations est modifié !!</div>';}
		elseif(isset($error)){$error="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Email existe !!</div>';}
		 ?>


<style>
.content input
{width:50%;}
</style>
        <section class="content" style="width:80%;margin-right:200px;">
        <form method="post" action="conducteur_information.php" class="form-horizontal" role="form">
        <div class="form-group">
    <label class="control-label col-sm-2" for="sexe">Sexe :</label>
    <div class="col-sm-10" style="margin-top:7px;"> 
      <span class="disabled" id="email" style="margin-left:20px;"><?php echo ucfirst($cond->sexe());?></span>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="nom">Nom :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input type="text" name="nom" class="form-control" required id="nom" value="<?php echo ucfirst($cond->nom());?>" placeholder="Entrez votre nom">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="prenom">Prénom:</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" name="prenom" class="form-control" required id="prenom" value="<?php echo ucfirst($cond->prenom());?>" placeholder="Entrez votre prénom">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="email">Email :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="email" name="email" class="form-control" required value="<?php echo ucfirst($cond->email());?>" id="email" style="background-image:url(images/mail1.png);background-position:450px;background-size:25px 25px; background-repeat:no-repeat;" placeholder="Entrez votre email">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
        <label for="date" class="control-label col-sm-2"  class="input-group-addon btn">Date naissance :</label>
            <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
                <input id="date" name="date" type="text"  required value="<?php echo $cond->date_naissance();?>" placeholder="Entrez votre date de naissance" style="background-image:url(images/Calendar_Grey__white.png);background-position:450px;background-size:25px 25px; background-repeat:no-repeat;" class="date-picker form-control" />
       <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
        </div>
        </div>
    <script>
	$(".date-picker").datepicker({
				maxDate:-6940,
		dateFormat:"yy-mm-dd"});
	</script>

  <div class="form-group">
    <label class="control-label col-sm-2" for="tel">Telephone :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" name="tel" class="form-control" id="tel" value="<?php echo $cond->tel();?>" style="background-image:url(images/contact.png);background-position:450px;background-size:25px 25px; background-repeat:no-repeat;" placeholder="Entrez votre numéro de téléphone">
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
