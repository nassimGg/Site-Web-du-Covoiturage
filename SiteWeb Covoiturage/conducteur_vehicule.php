<?php 
session_start();
//appel vehicule
require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
$manager1=new ConducteurManager();
$managerv=new VoitureManager();

$conds=$manager1->getlist();
$id=$_SESSION['user_cond'];
$cond=$manager1->get($id);
$voitures=$managerv->getlist($id);
$i=0;$j=0;$y=0;$x=0;$z=0;

foreach($voitures as $voiture)
{$x++;
//modifier les informations d'une voiture
if(isset($_POST['bouton_modifier'.$x.'']))
		{$marque=$_POST['marque'.$x.''];
$annee=$_POST['annee'.$x.''];
$kilo=$_POST['kilo'.$x.''];
$place=$_POST['place'.$x.''];
$couleur=$_POST['couleur'.$x.''];
$voiture->setMarque($marque);
$voiture->setAnnee($annee);
$voiture->setKilometrage($kilo);
$voiture->setNb_place($place);
$voiture->setCouleur($couleur);

if($managerv->update($voiture))
			{$_SESSION['mod_v']=2;
			}
		}
		//suppression d'une voiture
if(isset($_POST['bouton_supp'.$x.'']))
		{if($managerv->countV($id)>1)
			{if($managerv->delete($voiture))
					{$_SESSION['supp_v']=1;$manager1->redirect('conducteur_vehicule.php');
					}
			}
		else
			{
				$_SESSION['supp_v']=0;
			}
		}
		//ajouter une photo a une voiture
if(isset($_POST['bouton_photo'.$x.'']))
{
	if(is_uploaded_file($_FILES['image']['tmp_name']))
	{ 
    $folder = "profil_photo/"; 
    $file = basename( $_FILES['image']['name']); 
    $full_path = $folder.$file; 
    move_uploaded_file($_FILES['image']['tmp_name'], $full_path);
	}
$voiture->setPhoto($file);
	if($managerv->update($voiture))
		{$_SESSION['mod_pv']=1;
		}
}		
		
}
//ajouter une voiture
if(isset($_POST['bouton_enregistrer']))
{$num=$_POST['imm'];
$marque=$_POST['marque'];
$annee=$_POST['annee'];
$kilo=$_POST['kilo'];
$place=$_POST['place'];
$couleur=$_POST['couleur'];

$voituren=new Voiture(array('num_imm'=>$num,'marque'=>$marque,'annee'=>$annee,'kilometrage'=>$kilo,'nb_place'=>$place,'couleur'=>$couleur,'id_conducteur'=>$id));
if($managerv->add($voituren)){$manager1->redirect('conducteur_vehicule.php');}}


?>



<!DOCTYPE html>

<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Véhicule | EtuCovoiturage</title>
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
  <style>
  #content
  {display: -webkit-flex;
    display: flex;
  }
  #ajou_photo a
  { 
  color:white;
  }
  #ajou_photo a:hover
  { text-decoration:underline;
  color:#111;
  }
  
  </style>
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
 
            <li class="active treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_information.php">Informations personnelles</a></li>
                <li><a href="conducteur_photo.php">Photo</a></li>
                <li><a href="conducteur_vehicule.php">Véhicule</a></li>
                <li><a href="conducteur_preference.php">Préférences</a></li>
              </ul>
            </li>
            <li class=" treeview"><a href="#"><i class="fa fa-linkedin-square"></i> <span>Compte</span><i class="fa fa-angle-left pull-right"></i></a>
            <ul class="treeview-menu">
                <li><a href="conducteur_mot_passe.php">Mot de passe</a></li>
                <li><a href="conducteur_fermer_compte.php">Fermeture compte</a></li>
              </ul>
            </li>
            <li><a href="conducteur_annonce.php"><i class="fa fa-linkedin-square"></i> <span>Vos annonces</span></a></li>
            <li><a href="publier_annonce.php"><i class="fa fa-linkedin-square"></i> <span>Publier trajet</span></a></li>
          </ul>
        </section>

      </aside>

      
      <div class="content-wrapper">
      

        <section class="content-header" style="margin-bottom:20px;border-bottom:2px solid #3c8dbc;width:70%;padding-bottom:7px;margin-left:150px; ">
          <h1>
            Véhicule
            
          </h1>
        </section>
        <?php if(isset($_SESSION['supp_v'])&& $_SESSION['supp_v']==1){$_SESSION['supp_v']="";echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre voiture est supprimé !!</div>';}
		elseif(isset($_SESSION['supp_v'])&& $_SESSION['supp_v']==0){$_SESSION['supp_v']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#ffbaba;">
		<i style="color:#770000;margin-right:30px;" class="fa fa-warning"></i> Tu ne peux pas supprimer parce que 
		il faut avoir dans votre compte au moins une voiture !!</div>';}
		elseif(isset($_SESSION['mod_v'])&& $_SESSION['mod_v']==2){$_SESSION['mod_v']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
		<i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre voiture est modifié !!</div>';} 
		elseif(isset($_SESSION['mod_pv'])&& $_SESSION['mod_pv']==1){$_SESSION['mod_pv']="";echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
		<i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> La photo de votre voiture est modifié !!</div>';} 
		?>
        
        <section class="content" style="background-color:#3c8dbc;height:auto;color:white;border-radius:5px;margin-left:150px;margin-right:50px;padding-left:30px;padding-right:80px;width:70%">
            <div id="b_content">
             <?php foreach($voitures as $voiture)
			 {$i++;
				 echo '<div id="content" style="margin-bottom:20px;" class="col-sm-offset-2 col-sm-10">
               <div>';if($voiture->photo()!=""){echo '<img src="profil_photo/'.$voiture->photo().'" height="90px" width="170px" style="border-radius:100%;"/>';}else{echo '<img src="profil_photo/car.png" style="border-radius:100%;"/>';}
			   echo ' <br><div id="ajou_photo" style="margin-top:7px;margin-left:20px;">
	   <a onClick="showajout'.$i.'()"style="cursor:pointer;font-size:16px;">Ajouter une photo</a></div>
       </div>
       <div style="margin-left:30px;"><strong><span style="margin-right:5px;">'.$voiture->marque().'</span>  <span>'.$voiture->annee().'</span></strong><br>'.$voiture->nb_place().' places

<br>
       <i class="fa fa-pencil" onClick="show_edit'.$i.'()" style="margin-top:10px; cursor:pointer;color:#00CC66;margin-right:20px;"></i>
	   <i class="fa fa-remove" onclick="showDialog'.$i.'()" style="cursor:pointer;color:#ffc4c4;"></i>
	   </div>
       </div>
	   <script>
		function show_edit'.$i.'()
		{document.getElementById("edit_voiture'.$i.'").style.display="block";
		 document.getElementById("add_voiture").style.display="none";
		 document.getElementById("b_content").style.display="none";
		}
		 function show_add()
		 {document.getElementById("add_voiture").style.display="block";
		 '; foreach($voitures as $voiture){$y++; echo'document.getElementById("edit_voiture'.$y.'").style.display="none";';} echo'
		 document.getElementById("b_content").style.display="none";
		 }
         </script>';
			 }
	   foreach($voitures as $voiture){$z++;echo'
	   <div id="white-background'.$z.'">
</div>
<div id="dlgbox'.$z.'">
    <div id="dlg-header">Please Confirm</div>
    <div id="dlg-body">Vous voulez vraiment supprimer cette voiture ?</div>
    <div id="dlg-footer" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="conducteur_vehicule.php" style=" margin-left:280px;">
	<input type="text" hidden="true" value="'.$z.'" name="voiture'.$z.'">
        <button type="submit" style="width:50px;" name="bouton_supp'.$z.'" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHide'.$z.'()">Annuler</button>
    </div>
</div>

<style>
        #white-background'.$z.'{
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

        #dlgbox'.$z.'{
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
	function showajout'.$z.'()
	{document.getElementById("ajout_photo'.$z.'").style.display="block";
		 document.getElementById("b_content").style.display="none";
	}
	function dlgHide'.$z.'(){
        var whitebg = document.getElementById("white-background'.$z.'");
        var dlg = document.getElementById("dlgbox'.$z.'");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }
	function showDialog'.$z.'(){
        var whitebg = document.getElementById("white-background'.$z.'");
        var dlg = document.getElementById("dlgbox'.$z.'");
        whitebg.style.display = "block";
        dlg.style.display = "block";

        var winWidth = window.innerWidth;

        dlg.style.left = (winWidth/2) - 480/2 + "px";
        dlg.style.top = "150px";
    }
	</script>';}?>            
    
       <div class="col-sm-offset-2 col-sm-10">
       <button style="margin-top:20px;;margin-left:5px;" class="btn btn-default" onClick="show_add()">Ajouter un véhicule</button>
         </div>
         </div>
         
         <script>
		 function show_add()
		 {document.getElementById('add_voiture').style.display="block";
		 document.getElementById('b_content').style.display="none";
		 }
         </script>
         
         
         <div id="add_voiture" hidden="true">
         <form action="conducteur_vehicule.php" method="post" class="form-horizontal" role="form">
        <div class="form-group">
    <label class="control-label col-sm-2" for="imm">Numéro immatriculation:</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="imm" required name="imm" placeholder="Entrez numéro d'immatriculation">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="marque">Marque :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input type="text" class="form-control" id="marque" required name="marque" placeholder="Entrez votre marque">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="annee">Année :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="annee" required name="annee"  placeholder="Entrez l&acute;année de votre voiture">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="kilo">Kilométrage :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="kilo" required name="kilo"  placeholder="Entrez kilométrage">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
        <label  class="control-label col-sm-2" for="place">Nombre place :</label>
            <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
                <input  type="number" class="form-control" required min="1" max="9" id="place" name="place" placeholder="Entrez nombre de place" />
       <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
        </div>
        </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="couleur">Couleur :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="couleur" required name="couleur" placeholder="Entrez couleur">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="bouton_enregistrer" class="btn btn-default">Enregistrer</button>
    </div>
  </div>
</form>
<button class="btn btn-default" style="width:120px;position:relative;top:-50px;left:220px;" onclick="dlgHidef()">Annuler</button>
<script>
	
	function dlgHidef(){
        var whitebg = document.getElementById('add_voiture');
		 
        var dlg = document.getElementById('b_content');
        whitebg.style.display = "none";
        dlg.style.display = "block";
    }
	
	</script>
</div>
<?php $v=0;
 foreach($voitures as $voit)
{$v++;
echo '<div id="ajout_photo'.$v.'" hidden="true" style="margin-left:200px;margin-top:100px;">
<form action="conducteur_vehicule.php"  method="post" class="form-horizontal"  enctype="multipart/form-data">
<div style="display: -webkit-flex;
    display: flex;">
	<div style="margin-top:10px;font-size:16px;">
 <label class="control-label col-sm-2" style="width:100%;" for="imm">Ajouter photo :</label>
   </div>
    <div style="position:relative; margin-left:50px;margin-top:10px;margin-bottom:20px;">
	';?>
		<a style="background-color:gray;colo:blue;" class='btn btn-primary' href='javascript:;'>
        <?php echo'
			Choisir photo...
			<input type="file" style="background-color:gray;position:absolute;z-index:2;top:0;left:0;filter: alpha(opacity=0);
            -ms-filter:';?>'progid:DXImageTransform.Microsoft.Alpha(Opacity=0)'<?php echo';opacity:0;
            background-color:transparent;color:transparent;" 
            name="image" size="40" ';?> onchange="$('#upload-file-info').html($(this).val());" <?php echo '/>
		</a>
		&nbsp;
		<span class="label label-info" id="upload-file-info"></span>
        </div>
		</div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10" style="margin-left:0px;">
      <button type="submit" name="bouton_photo'.$v.'" style="width:120px;background-color:#36C;color:white;" class="btn btn-default">Enregistrer</button>
    </div>
    </div>
</form><button class="btn btn-default" style="width:120px;background-color:#36C;color:white;position:relative;top:-50px;left:180px;" onclick="dlgHidee'.$v.'()">Annuler</button>
	</div>
	<style>
	#butt'.$v.'{
	background-color: #6d84b4;
            color: white;
            padding: 5px;
			width:80px;
			border-radius:5px;
            border: 0;}
	</style>
	<script>
	
	function dlgHidee'.$v.'(){
        var whitebg = document.getElementById("ajout_photo'.$v.'");
        var dlg = document.getElementById("b_content");
        whitebg.style.display = "none";
        dlg.style.display = "block";
    }
	
	</script>';
}?>






<?php foreach($voitures as $voiture)
{$j++;
	echo '
	
<div id="edit_voiture'.$j.'" hidden="true">
       <form action="conducteur_vehicule.php" method="post" class="form-horizontal" role="form">
        <div class="form-group">
    <label class="control-label col-sm-2" for="num">Numéro  immatriculation :</label>
    <div class="col-sm-10" style="margin-top:7px;"> 
      <span class="disabled" id="num" style="margin-left:20px;">'.$voiture->num_imm().'</span>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="marque">Marque :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input type="text" class="form-control" id="marque" required name="marque'.$j.'" value="'.$voiture->marque().'" placeholder="Entrez votre marque">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
	</div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="annee">Année :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="annee" required name="annee'.$j.'" value="'.$voiture->annee().'" placeholder="Entrez l&acute;année de votre voiture">
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
	</div>
  </div>
    <div class="form-group">
    <label class="control-label col-sm-2" for="kilo">Kilométrage :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="kilo" required name="kilo'.$j.'" value="'.$voiture->kilometrage().'" placeholder="Entrez kilométrage">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
        <label for="place" class="control-label col-sm-2" class="input-group-addon btn">Nombre place :</label>
            <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
                <input id="place" type="number" required class="form-control" min="1" name="place'.$j.'" max="9" placeholder="Entrez nombre de place" value="'.$voiture->nb_place().'" />
        <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
		</div>
        </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="couleur">Couleur :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="text" class="form-control" id="couleur" required name="couleur'.$j.'" value="'.$voiture->couleur().'" placeholder="Entrez couleur">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" name="bouton_modifier'.$j.'" class="btn btn-default">Enregistrer</button>
    </div>
  </div>
</form>
<button class="btn btn-default" style="width:120px;position:relative;top:-50px;left:220px;" onclick="dlgHidef'.$j.'()">Annuler</button>
<script>
	
	function dlgHidef'.$j.'(){
        var whitebg = document.getElementById("edit_voiture'.$j.'");
		 
        var dlg = document.getElementById("b_content");
        whitebg.style.display = "none";
        dlg.style.display = "block";
    }
	
	</script>
</div>';
}?>
        </section>
      </div>

      <footer class="main-footer">

        <div class="pull-right hidden-xs">
          EtuCovoiturage
        </div>

        <strong>Covoiturage,2016 &copy;<a href="#"></strong>
      </footer>
    </div>
<script src="js/jQuery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>

    <script src="js/app.min.js"></script>
    
  </body>
</html>
