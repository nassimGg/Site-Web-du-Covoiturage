<?php 
session_start();
// fonction pour calculer l'age
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
// fin fonction
require_once ('dbconfig.php');
require_once ('Trajetmanager.class.php');
require_once ('Trajet.class.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Participantmanager.class.php');
require_once ('Participant.class.php');
require_once ('Voituremanager.class.php');
require_once ('Voiture.class.php');
require_once ('Commentairemanager.class.php');
require_once ('Commentaire.class.php');
require_once ('Villemanager.class.php');
require_once ('Ville.class.php');
require_once ('Reservation.class.php');
$managerco=new CommentaireManager();
$managerc=new ConducteurManager();
$managerp=new ParticipantManager();
$managervo=new VoitureManager();
$reservation=new Reservation();
$id=$_SESSION['user_cond'];
$conducteur=$managerc->get($id);
$managert=new TrajetManager();
$trajets=$managert->gett($id);
$managerville=new VilleManager();
$villes=$managerville->villelist();


if(count($trajets)>0)
{
foreach($trajets as $trajet)
{
//lorsque le conducteur peut modifier une annonce
if(isset($_POST['bouton_modifier'.$trajet->num_trajet().'']))
{$type=$_POST['frequence'.$trajet->num_trajet().''];
$date_aller=$_POST['date_aller'.$trajet->num_trajet().''];
$date_retour=$_POST['date_retour'.$trajet->num_trajet().''];
$details=$_POST['details'.$trajet->num_trajet().''];
$heure_aller=$_POST['heure1'.$trajet->num_trajet().'']."h".$_POST['minute_1'.$trajet->num_trajet().''];
$heure_retour=$_POST['heure2'.$trajet->num_trajet().'']."h".$_POST['minute_2'.$trajet->num_trajet().''];
$numville1=$managerville->get(utf8_decode($_POST['depart'.$trajet->num_trajet().'']));
$numville2=$managerville->get(utf8_decode($_POST['dest'.$trajet->num_trajet().'']));
$trajet->setType($type);
$trajet->setDate_aller($date_aller);
$trajet->setDate_retour($date_retour);
$trajet->setHeure_aller($heure_aller);
$trajet->setHeure_retour($heure_retour);
$trajet->setDescription($details);
$trajet->setNum_ville1($numville1);
$trajet->setNum_ville2($numville2);

if($managert->modifier($trajet))
{$_SESSION['mod_t']=1;}
}

//lorque le conducteur veut supprimer une annonce
if(isset($_POST['bouton_supp'.$trajet->num_trajet().'']))
{if($managert->delete($trajet))
{
$_SESSION['supp_t']=1;
$manager1->redirect('conducteur_annonce.php');
	}
}
}
}


//ajouter un commentaire 
if(isset($_POST['bouton_commentaire']))
{
	$commentaire=new Commentaire(array('contenu'=>utf8_decode($_POST['contenu']),'date_comm'=>date("Y-m-d"),'id_conducteur'=>1,'num_trajet'=>$_GET['num']));
	if($managerco->add($commentaire)){
	}
}


$comment=$managerco->listc();
foreach($comment as $commen)
{
	//suppression un commentaire
if(isset($_POST['bouton_supp_comm'.$commen->id_commentaire().'']))
{
	if($managerco->delete($commen))
	{	
	
	}

}}


?>


<!DOCTYPE html>

<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Annonces | EtuCovoiturage</title>
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
             
                  <img src="profil_photo/<?php echo $conducteur->photo();?>" class="user-image" alt="User Image">
                  
                  <span class="hidden-xs"><?php echo ucfirst($conducteur->prenom());?></span>
                </a>
                <ul class="dropdown-menu">
                
                  <li class="user-header">
                    <img src="profil_photo/<?php echo $conducteur->photo();?>" class="img-circle" alt="User Image">
                    <p>
                      <?php echo ucfirst($conducteur->prenom()).' '.ucfirst($conducteur->nom());?>
   
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
              <img src="profil_photo/<?php echo $conducteur->photo();?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p><?php echo ucfirst($conducteur->prenom());?></p>
  
              <a><i class="fa fa-circle text-success"></i> Online</a>
            </div>
          </div>

          <ul class="sidebar-menu">
   			<li><a href="conducteur.php"><i class="fa fa- fa-linkedin"></i> <span>Tableau de bord</span></a></li>
            <li class="treeview"><a href="#"><i class="fa fa-linkedin"></i> <span>Profil</span><i class="fa fa-angle-left pull-right"></i></a>
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
            <li class="active"><a href="conducteur_annonce.php"><i class="fa fa- fa-linkedin"></i> <span>Vos annonces</span></a></li>
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
            Annonces
          </h1>
        </section>
        <?php if(isset($_SESSION['supp_t'])&& $_SESSION['supp_t']==1){$_SESSION['supp_t']="";echo '
        <div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
        <i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre Trajet est supprimé !!</div>';}
		elseif(isset($_SESSION['mod_t'])&& $_SESSION['mod_t']==1){$_SESSION['mod_t']=""; echo '
		<div style="width:70%;margin-left:150px;font-size:16px;margin-bottom:20px;border-radius:5px;padding:10px;color:white;background-color:#3c8dbc;">
		<i style="color:green;margin-right:30px;" class="fa fa-check-square-o"></i> Votre trajet est modifié !!</div>';}
		?>

        <section class="content">
        
  <div id="b_content">
      <?php if(count($trajets)>0)  {echo '
<table class="table table-striped table-hover">
    <thead>
      <tr>
        <th>Num_trajet</th>
        <th>Type</th>
        <th>Ville_depart</th>
        <th>Ville_destination</th>
        <th>Date_aller</th>
        <th>Date_retour</th>
        <th>Heure_aller</th>
        <th>Heure_retour</th>
        <th>Prix</th>
        <th>ID_conducteur</th>
        <th></th>
		<th>Particpant_réserver</th>
      </tr>
    </thead>
    <tbody>';}
	?>
    <?php
if(count($trajets)>0)
{ 
foreach ($trajets as $trajet)
{$parts=$reservation->getp($trajet->num_trajet());
echo '<tr>' ;
echo '<td>',$trajet->num_trajet(),'</td>';
echo '<td>';if($trajet->type()=="A"){echo 'Aller';}else{echo 'Aller-Retour';}echo '</td>';
echo '<td>'.utf8_encode($managerville->getn($trajet->num_ville1())).'</td>';
echo '<td>'.utf8_encode($managerville->getn($trajet->num_ville2())).'</td>';
echo '<td>',$trajet->date_aller(),'</td>';
echo '<td>';if($trajet->date_retour()=="0000-00-00"){echo'';}else {echo $trajet->date_retour();}echo'</td>';
echo '<td>',$trajet->heure_aller(),'</td>';
echo '<td>',$trajet->heure_retour(),'</td>';
echo '<td>',$trajet->prix(),' DZD</td>';
echo '<td>',$trajet->id_conducteur(),'</td>';
echo '<td>';if(date("Y-m-d")>$trajet->date_aller()){echo '';} else {echo'<i class="fa fa-pencil" onClick="show_edit'.$trajet->num_trajet().'()" style="cursor:pointer;color:#00CC66;margin-right:20px;"></i>';} echo '<i class="fa fa-remove" onclick="showDialog'.$trajet->num_trajet().'()" style="cursor:pointer;color:#ffc4c4;"></i></td>';
echo '<td>';if(count($parts)>0){foreach($parts as $part){echo '<a style="cursor:pointer;" href="profil_participant.php?id='.$part->id().'"><img src="profil_photo/'.$part->photo().'" width="40px" height="40px" class="img-circle" alt="User Image"/></a>';}}
else{echo 'Aucune réservation';}

echo'</td>';
echo '<td><i onClick="show'.$trajet->num_trajet().'()" style="color:blue;cursor:pointer;" class="fa fa-forward"></i></td>
<script>
function show'.$trajet->num_trajet().'(){
	document.getElementById("annonce_affich'.$trajet->num_trajet().'").style.display= "block";
	document.getElementById("ann_aff_content'.$trajet->num_trajet().'").style.display= "block";
}
</script>';
echo '</tr>';
echo '<script>
		function show_edit'.$trajet->num_trajet().'()
		{document.getElementById("edit_trajet'.$trajet->num_trajet().'").style.display="block";
		 document.getElementById("b_content").style.display="none";
		}
         </script>';
}
?>
    </tbody>
  </table>
<?php 
foreach($trajets as $trajet){echo'
	   <div id="white-background'.$trajet->num_trajet().'">
</div>
<div id="dlgbox'.$trajet->num_trajet().'">
    <div id="dlg-header">Confirmation</div>
    <div id="dlg-body">Vous voulez vraiment supprimer ce trajet ?</div>
    <div id="dlg-footer" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="conducteur_annonce.php" style=" margin-left:280px;">
	<input type="text" hidden="true" value="'.$trajet->num_trajet().'" name="trajet'.$trajet->num_trajet().'">
        <button type="submit" style="width:50px;" name="bouton_supp'.$trajet->num_trajet().'" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHide'.$trajet->num_trajet().'()">Annuler</button>
    </div>
</div>
	
<style>
        #white-background'.$trajet->num_trajet().'{
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

        #dlgbox'.$trajet->num_trajet().'{
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
	function dlgHide'.$trajet->num_trajet().'(){
        var whitebg = document.getElementById("white-background'.$trajet->num_trajet().'");
        var dlg = document.getElementById("dlgbox'.$trajet->num_trajet().'");
        whitebg.style.display = "none";
        dlg.style.display = "none";
    }
	function showDialog'.$trajet->num_trajet().'(){
        var whitebg = document.getElementById("white-background'.$trajet->num_trajet().'");
        var dlg = document.getElementById("dlgbox'.$trajet->num_trajet().'");
        whitebg.style.display = "block";
        dlg.style.display = "block";

        var winWidth = window.innerWidth;

        dlg.style.left = (winWidth/2) - 480/2 + "px";
        dlg.style.top = "150px";
    }
	</script>';}}
else
{
	echo '<div style="text-align:center;font-size:18px;">Aucune annonces.</div>';
}
?>  
  </div>

<?php
if(count($trajets)>0){
 foreach($trajets as $trajet)
  {echo '
  <div id="edit_trajet'.$trajet->num_trajet().'" hidden="true">
  <form action="conducteur_annonce.php" method="post" class="form-horizontal" role="form">
        <div class="form-group">
    <label class="control-label col-sm-2" for="freuence">Fréquence:</label>
    <div class="col-sm-10" > 
      <input type="radio" class="form-group-lg" id="frequence" ';if($trajet->type()=="A"){echo ' checked';}echo'  onClick="retour_hide()" value="A" name="frequence'.$trajet->num_trajet().'">Aller
      <input type="radio" class="form-group-lg" value="R" id="frequence" ';if($trajet->type()=="R"){echo ' checked';}echo'  onClick="retour_show()" name="frequence'.$trajet->num_trajet().'">Aller-Retour
  <script>
  function retour_hide()
  {
  document.getElementById("retour").style.display="none";
  
  }
  function retour_show()
  {document.getElementById("retour").style.display="block";
  }
  </script>
    </div>
  </div>
<div class="form-group">
    <label class="control-label col-sm-2" for="depart">Point de départ :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input id="depart" list="villes" required value="'.utf8_encode($managerville->getn($trajet->num_ville1())).'" name="depart'.$trajet->num_trajet().'" type="text"  placeholder="De" style="background-image: url(images/cercle_vert.png); background-size: 20px 25px; background-position: 5px 5px; border: 2px solid #ccc;
 border-radius: 5px; font-size: 16px; color: black;  background-repeat: no-repeat;padding-left:40px;">
<datalist id="villes">
';
foreach ($villes as $villee)
{$vill = utf8_encode($villee->nom_ville()); 
echo '<option value="', $vill,'">';
}
echo'
  </datalist>
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="dest">Point d&acute;arrivé :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
      <input id="dest" required name="dest'.$trajet->num_trajet().'" type="text" value="'.utf8_encode($managerville->getn($trajet->num_ville2())).'"  placeholder="Á" style=" background-size:20px 25px;  background-image:url(images/cercle_rouge.png);
padding-left:40px;
  background-position:5px 5px;
    border: 2px solid #ccc;
    border-radius: 5px;
    font-size: 16px;
   color:black;

    background-repeat: no-repeat;" list="villes"autocomplete="on">
<datalist id="villes">
';
foreach ($villes as $villee)
{$vill = utf8_encode($villee->nom_ville()); 
echo '<option value="', $vill,'">';
}
echo '
  </datalist>
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label for="date" class="control-label col-sm-2" class="input-group-addon btn">Aller :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
	    <input type="text" required name="date_aller'.$trajet->num_trajet().'" id="date" value="'.$trajet->date_aller().'" class="date-picker" placeholder="AAAA-MM-JJ" 
		style=" background-image:url(images/calandaricon.png);
  background-size:20px 25px;
padding-left:40px;
  background-position:5px 5px;
    border: 2px solid #ccc;
    border-radius: 5px;
margin-right:20px;
    background-color: white;
    background-repeat: no-repeat;">
	<script>
	$(".date-picker").datepicker({
				maxDate:-6940,
		dateFormat:"yy-mm-dd"});
	</script>
<select required name="heure1'.$trajet->num_trajet().'" 
style="margin-right:10px;
    border: 2px solid #ccc;
    border-radius: 5px;
    background-color: white;
    ">
<option></option>
<option ';if(substr($trajet->heure_aller(),0,2)=="00"){echo 'selected';}echo' value="00">00</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="01"){echo 'selected';}echo' value="01">01</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="02"){echo 'selected';}echo' value="02">02</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="03"){echo 'selected';}echo' value="03">03</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="04"){echo 'selected';}echo' value="04">04</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="05"){echo 'selected';}echo' value="05">05</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="06"){echo 'selected';}echo' value="06">06</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="07"){echo 'selected';}echo' value="07">07</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="08"){echo 'selected';}echo' value="08">08</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="09"){echo 'selected';}echo' value="09">09</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="10"){echo 'selected';}echo' value="10">10</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="11"){echo 'selected';}echo' value="11">11</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="12"){echo 'selected';}echo' value="12">12</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="13"){echo 'selected';}echo' value="13">13</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="14"){echo 'selected';}echo' value="14">14</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="15"){echo 'selected';}echo' value="15">15</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="16"){echo 'selected';}echo' value="16">16</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="17"){echo 'selected';}echo' value="17">17</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="18"){echo 'selected';}echo' value="18">18</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="19"){echo 'selected';}echo' value="19">19</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="20"){echo 'selected';}echo' value="20">20</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="21"){echo 'selected';}echo' value="21">21</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="22"){echo 'selected';}echo' value="22">22</option>
<option ';if(substr($trajet->heure_aller(),0,2)=="23"){echo 'selected';}echo' value="23">23</option>
</select>
<div style="font-size:20px;margin-top:5px;">h</div>
<select name="minute_1'.$trajet->num_trajet().'" required style="
  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
 margin-left:10px;
    background-color: white;
    ">
<option></option>
<option ';if(substr($trajet->heure_aller(),3,2)=="00"){echo 'selected';}echo' value="00">00</option>
<option ';if(substr($trajet->heure_aller(),3,2)=="10"){echo 'selected';}echo' value="10">10</option>
<option ';if(substr($trajet->heure_aller(),3,2)=="20"){echo 'selected';}echo' value="20">20</option>
<option ';if(substr($trajet->heure_aller(),3,2)=="30"){echo 'selected';}echo' value="30">30</option>
<option ';if(substr($trajet->heure_aller(),3,2)=="40"){echo 'selected';}echo' value="40">40</option>
<option ';if(substr($trajet->heure_aller(),3,2)=="50"){echo 'selected';}echo' value="50">50</option>
</select><br>
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
    <div id="retour"';if($trajet->type()=="A"){echo 'hidden="true"';}echo' class="form-group">
   <label for="date" class="control-label col-sm-2" class="input-group-addon btn">Retour :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
	    <input type="text" required name="date_retour'.$trajet->num_trajet().'" id="date" value="'.$trajet->date_retour().'" class="date-picker" placeholder="AAAA-MM-JJ" style=" background-image:url(images/calandaricon.png);
  background-size:20px 25px;
padding-left:40px;
  background-position:5px 5px;
    border: 2px solid #ccc;
    border-radius: 5px;
margin-right:20px;

    background-color: white;
    background-repeat: no-repeat;">
	<script>
	$(".date-picker").datepicker({
				maxDate:-6940,
		dateFormat:"yy-mm-dd"});
	</script>
<select name="heure2'.$trajet->num_trajet().'" style="

  background-position:5px 3px;
    border: 2px solid #ccc;
    border-radius: 5px;
margin-right:10px;
    background-color: white;">
<option></option>
<option ';if(substr($trajet->heure_retour(),0,2)=="00"){echo 'selected';}echo' value="00">00</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="01"){echo 'selected';}echo' value="01">01</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="02"){echo 'selected';}echo' value="02">02</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="03"){echo 'selected';}echo' value="03">03</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="04"){echo 'selected';}echo' value="04">04</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="05"){echo 'selected';}echo' value="05">05</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="06"){echo 'selected';}echo' value="06">06</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="07"){echo 'selected';}echo' value="07">07</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="08"){echo 'selected';}echo' value="08">08</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="09"){echo 'selected';}echo' value="09">09</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="10"){echo 'selected';}echo' value="10">10</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="11"){echo 'selected';}echo' value="11">11</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="12"){echo 'selected';}echo' value="12">12</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="13"){echo 'selected';}echo' value="13">13</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="14"){echo 'selected';}echo' value="14">14</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="15"){echo 'selected';}echo' value="15">15</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="16"){echo 'selected';}echo' value="16">16</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="17"){echo 'selected';}echo' value="17">17</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="18"){echo 'selected';}echo' value="18">18</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="19"){echo 'selected';}echo' value="19">19</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="20"){echo 'selected';}echo' value="20">20</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="21"){echo 'selected';}echo' value="21">21</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="22"){echo 'selected';}echo' value="22">22</option>
<option ';if(substr($trajet->heure_retour(),0,2)=="23"){echo 'selected';}echo' value="23">23</option>
</select> 
<div style="font-size:20px;margin-top:5px;">h</div>
<select  name="minute_2'.$trajet->num_trajet().'" 
style="border: 2px solid #ccc;
border-radius: 5px;
margin-left:10px;
background-color: white;">
<option></option>
<option ';if(substr($trajet->heure_retour(),3,2)=="00"){echo 'selected';}echo' value="00">00</option>
<option ';if(substr($trajet->heure_retour(),3,2)=="10"){echo 'selected';}echo' value="10">10</option>
<option ';if(substr($trajet->heure_retour(),3,2)=="20"){echo 'selected';}echo' value="20">20</option>
<option ';if(substr($trajet->heure_retour(),3,2)=="30"){echo 'selected';}echo' value="30">30</option>
<option ';if(substr($trajet->heure_retour(),3,2)=="40"){echo 'selected';}echo' value="40">40</option>
<option ';if(substr($trajet->heure_retour(),3,2)=="50"){echo 'selected';}echo' value="50">50</option>
</select>
    <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
        <label  class="control-label col-sm-2" for="prix">Prix de voyage :</label>
            <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;">
                <input  type="number" class="form-control" required  id="place" name="prix'.$trajet->num_trajet().'" value="'.$trajet->prix().'" 
				style="width:40%; 
padding-left:40px;height:37px;
    border: 2px solid #ccc;font-size:16px;
    border-radius: 5px 0px 0px 5px;

    background-color: white;" placeholder="Entrez prix" />
                <input  type="text" class="form-control"  id="place" disabled value="DZD" 
				style="width:10%; cursor:default;
				font-weight:bold;text-align:center;font-size:16px;
	
padding-left:15px;height:37px;

    border: 2px solid #ccc;
    border-radius: 0px 5px 5px 0px;


    background-color: white;" />
       <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
        </div>
        </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="place">Nombre de place :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <input type="number" min="1" max="5" class="form-control" id="place" value="'.$trajet->nombre_place().'" required name="place'.$trajet->num_trajet().'" placeholder="Entrez nombre de place"
	  style="  height:37px;font-size:16px;
padding-left:40px;

    border: 2px solid #ccc;
    border-radius: 5px;


    background-color: white;">
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group">
    <label class="control-label col-sm-2" for="details">Détails :</label>
    <div class="col-sm-10" style="display: -webkit-flex;
    display: flex;"> 
      <textarea class="form-control" id="details" value="'.$trajet->description().'" name="details'.$trajet->num_trajet().'" 
	 placeholder="Exemple : “Je vais rendre visite à ma famille à Alger, je partirai de l&acute;auto route l&acute;est et ouest à 10h. Il y a de la place pour une petite valise par personne et votre musique sera la bienvenue !”"
	 rows="4" cols="70" style="  font-size:16px;
padding-left:40px;

    border: 2px solid #ccc;
    border-radius: 5px;


    background-color: white;"></textarea>
   <span style="margin-left:7px;color:red;font-size:25px;margin-top:6px;">*</span>
    </div>
  </div>
  <div class="form-group"> 
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" style="color:white;" name="bouton_modifier'.$trajet->num_trajet().'" class="btn btn-default btn-primary">Enregistrer</button>
    </div>
  </div>
</form>
<div class="col-sm-12">
<button  class="btn btn-default btn-primary" style="color:white;position:relative;top:-48px;left:300px;" onClick="retour()"> Retour</button>
</div>
</div>';}}
echo'
<script>
function retour(){
';if(count($trajets)>0){foreach($trajets as $trajet)
{echo 'document.getElementById("edit_trajet'.$trajet->num_trajet().'").style.display="none";
		 ';}}
echo'document.getElementById("b_content").style.display="block";}
</script>';?>
<?php 
foreach ($trajets as $traj)
{
echo
'<style>
#annonce_affich'.$traj->num_trajet().' {
display: none;
            width: 100%;
            height: 100%;
            position: fixed;
            top: 0;
            left: 0;
            background-color: #fefefe;
            opacity: 0.9;
            z-index: 9999;
}
#ann_aff_content'.$traj->num_trajet().'{
            display: none;
            position: fixed;
            width: 65%;
			font-size:16px;
			color:white;
			padding:10px 15px 15px 15px;
			left:200px;
			opacity:1;
			top:10px;
			background-size:cover;
			background-image:url(images/connexion.png);
            z-index: 9999;
            border-radius: 10px;

}
#ann_aff_content'.$traj->num_trajet().' input[type="submit"]{
width:100%;padding:15px 15px 15px 15px;border-radius:5px;border:#fa6c65;
                    margin-top:10px;color:white;
                                                   background-color:#ba5a75;}
#img_close'.$traj->num_trajet().'
{position:absolute;
left:-15px;
top:-10px;
cursor:pointer;
}
</style>';
}
?>


    <?php 
	foreach ($trajets as $traj)
	{
		$cond=$managerc->get($traj->id_conducteur());
$age=age($cond->date_naissance());
$voiture= $managervo->getlist($cond->id());
$commentaires=$managerco->getlist($traj->num_trajet());
	echo 
'<div id="annonce_affich'.$traj->num_trajet().'">
	<div id="ann_aff_content'.$traj->num_trajet().'">
	<img style="cursor:pointer;position:relative;top:-20px;left:-30px;" id="img_close'.$traj->num_trajet().'" src="images/close-button.png" width="30px" height="30px" 
onClick="hide'.$traj->num_trajet().'()"/>
	<script>
	function hide'.$traj->num_trajet().'(){
		document.getElementById("annonce_affich'.$traj->num_trajet().'").style.display= "none";
document.getElementById("ann_aff_content'.$traj->num_trajet().'").style.display= "none";
	}
	</script>
		<div style=" display: -webkit-flex;
    display: flex;text-align:center;border:1px solid;width:97.5%;border-radius:5px;padding-left:350px;margin-bottom:10px;margin-top:-20px;">
    
<h1 style="margin-right:10px;">'.utf8_encode($managerville->getn($traj->num_ville1())).' </h1>
<img src="images/forward.png" width="80px" height="50px" style="margin-top:10px;"/>
<h1 style="margin-left:10px;">'.utf8_encode($managerville->getn($traj->num_ville2())).'</h1>
		</div>
		<div style=" display: -webkit-flex;
    display: flex;">
   
			<div id="information" 
			style="padding-left:30px; border:1px solid;border-radius:5px;padding-right:50px;padding-top:15px;width:54%;">
					<p style="color:white;">Départ 
					<img src="images/cercle_vert.png" width="20px" height="20px" style="margin-left:150px;margin-right:15px;position:relative;top:3px;"/>
					'.utf8_encode($managerville->getn($traj->num_ville1())).'</p>

					<p style="color:white;">Arrivée 
					<img src="images/cercle_rouge.png" width="20px" height="20px" style="margin-left:150px;margin-right:15px;position:relative;top:3px;"/>
					'.utf8_encode($managerville->getn($traj->num_ville2())).'</p>

					<p style="color:white;">Date de départ 
					<img src="images/Calendar_Grey__white.png" width="20px" height="20px" style=" margin-left:95px;margin-right:15px;position:relative;top:3px;"/>
					'.$traj->date_aller().' à '.$traj->heure_aller().'</p>
					';if($traj->type()=="R"){ echo '
					<p style="color:white;">Date de retour 
					<img src="images/Calendar_Grey__white.png" width="20px" height="20px" style=" margin-left:95px;margin-right:15px;position:relative;top:3px;"/>
					'.$traj->date_retour().' à '.$traj->heure_retour().'</p>';} echo '

					<p style="color:white;">Détails </p>
                    <div style=" display: -webkit-flex;
    display: flex;background-color:#33CCCC;border-radius:5px;padding-left:15px;width:100%;">
                      <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="40px" height="40px"/>
                    <p style="color:white; margin-left:10px;margin-top:7px;">
					<strong>'.ucfirst($cond->prenom()).'</strong><br>';
					if($traj->description()==""){ echo'
                    Le conducteur n&acute;a pas donné plus de détails sur son trajet.';}
					else { echo utf8_encode($traj->description());}echo '</p>
                    </div>
			<div style="margin-top:20px;">
			<span style="margin-top:20px;">Commentaires</span><br>
			</div>'; 
			if(count($commentaires)>0) 
				{foreach ($commentaires as $comm) 
				{if ($comm->id_participant()!='') 
				{$part=$managerp->get($comm->id_participant()); echo ' 
			
					<div style="display: -webkit-flex;
    display: flex;">
					 <img id="profil"src="profil_photo/'.$part->photo().'" style="border-radius:100%;
					 margin-right:20px;margin-top:30px;" width="40px" height="40px"/>
					<div>
					<div style="margin-top:10px;margin-bottom:-10px;margin-left:30px;">
					<strong style="margin-right:5px;">'.ucfirst($part->prenom()).'</strong><small> '.$comm->date_comm().'</small>
					</div>
					<div class="dialogbox">
    <div class="body">
      <span class="tip tip-left"></span>
      <div class="message">
        <span>'.utf8_encode($comm->contenu()).'</span>
      </div>
    </div>
  </div>
  </div></div>';}
  elseif ($comm->id_conducteur()!='') 
				{$cond=$managerc->get($comm->id_conducteur()); echo ' 
			
					<div style="display: -webkit-flex;
    display: flex;">
					 <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;
					 margin-right:20px;margin-top:30px;" width="40px" height="40px"/>
					<div>
					<div style="margin-top:10px;margin-bottom:-10px;margin-left:30px;">
					<strong style="margin-right:5px;">'.ucfirst($cond->prenom()).'</strong><small> '.$comm->date_comm().'</small>
					</div>
					<div class="dialogbox">
    <div class="body">
      <span class="tip tip-left"></span>
      <div class="message">
        <span>'.utf8_encode($comm->contenu()).'</span>
      </div>
    </div>
  </div>
  </div>
  ';if(($cond->id()==$conducteur->id()) && ($cond->nom()==$conducteur->nom()) && ($cond->prenom()==$conducteur->prenom()) && 
  ($cond->email()==$conducteur->email())){echo ' 
  <i class="fa fa-remove" onClick="showsupp'.$comm->id_commentaire().'()" style="color:pink;margin-top:55px;cursor:pointer; margin-left:10px;"></i>';} echo'
  </div>
  <div id="white-backgroundc'.$comm->id_commentaire().'">
</div>
<div id="dlgboxc'.$comm->id_commentaire().'">
    <div id="dlg-headerc">Confirmation</div>
    <div id="dlg-bodyc">Vous voulez vraiment supprimer ce commentaire ?</div>
    <div id="dlg-footerc" style="display: -webkit-flex;
    display: flex;">
	<form method="post" action="conducteur_annonce.php" style=" margin-left:280px;">
	<input type="text" hidden="true" name="comm'.$comm->id_commentaire().'" id="comm'.$comm->id_commentaire().'">
	';$_SESSION['id_comm']=1;echo'
        <button type="submit" style="width:50px;" name="bouton_supp_comm'.$comm->id_commentaire().'" onclick="dlgOK()">OK</button>
        </form><button style="margin-left:20px;" onclick="dlgHidec'.$comm->id_commentaire().'()">Annuler</button>
    </div>
</div>
	
<style>
        #white-backgroundc'.$comm->id_commentaire().'{
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

        #dlgboxc'.$comm->id_commentaire().'{
            /*initially dialog box is hidden*/
            display: none;
            position: fixed;
            width: 480px;
            z-index: 9999;
            border-radius: 10px;
            background-color: #7c7d7e;
        }

        #dlg-headerc{
            background-color: #6d84b4;
            color: white;
            font-size: 20px;
            padding: 10px;
            margin: 10px 10px 0 10px;
        }

        #dlg-bodyc{
            background-color: white;
            color: black;
            font-size: 14px;
            padding: 10px;
            margin: 0 10px 0 10px;
        }

        #dlg-footerc{
            background-color: #f2f2f2;
            text-align: right;
            padding: 10px;
			
            margin: 0 10px 10px 10px;
        }

        #dlg-footerc button{
            background-color: #6d84b4;
            color: white;
            padding: 5px;
			width:80px;
			border-radius:5px;
            border: 0;
        }
    </style>
	<script>
	function dlgHidec'.$comm->id_commentaire().'(){
        var whitebgc = document.getElementById("white-backgroundc'.$comm->id_commentaire().'");
        var dlgc = document.getElementById("dlgboxc'.$comm->id_commentaire().'");
		
        whitebgc.style.display = "none";
        dlgc.style.display = "none";
    }
	function showsupp'.$comm->id_commentaire().'(){
        var whitebgc = document.getElementById("white-backgroundc'.$comm->id_commentaire().'");
        var dlgc = document.getElementById("dlgboxc'.$comm->id_commentaire().'");
        whitebgc.style.display = "block";
        dlgc.style.display = "block";

        var winWidth = window.innerWidth;

        dlgc.style.left = (winWidth/2) - 480/2 + "px";
        dlgc.style.top = "150px";
    }
	</script>';}}}
  else
  { echo 'Aucun commentaire';} 
  echo'
  <div style="margin-bottom:40px;">
  <form method="post" action="conducteur_annonce.php?num='.$traj->num_trajet().'">
  <label for="comment"></label><br>
<textarea name="contenu" style="border-radius:5px;padding:5px 10px 5px 15px;" placeholder="Tapez votre commentaire" class="form-control" rows="3" cols="70" id="comment"></textarea><br>

      
	  <input type="submit" name="bouton_commentaire" value="Laisser un commentaire" style="width:50%;">
  
  </form>
  </div>
					
					

			</div>
			<style>
			.tip {
  width: 0px;
  height: 0px;
  position: absolute;
  background: transparent;
  border: 10px solid #ccc;
}



.tip-left {
  top: 10px;
  left: -25px;
  border-top-color: transparent;
  border-left-color: transparent;
  border-bottom-color: transparent;  
}


.dialogbox .body {
  position: relative;
  width: 300px;
  height: auto;
  margin: 20px 10px;
  padding: 5px;
  background-color: #DADADA;
  border-radius: 3px;
  border: 5px solid #ccc;
}

.body .message {
  min-height: 30px;
  border-radius: 3px;
  font-family: Arial;
  font-size: 14px;
  line-height: 1.5;
  color: #797979;
}
			</style>
			<div style="margin-left:30px;">
               <div style="border:1px solid;border-top:4px solid #58b20d; border-radius:5px;">
					<div style=" display: -webkit-flex;
    display: flex;width:100%;border-bottom:1px solid;">
							<div style="padding:10px 40px 10px 40px;text-align:center;">
                           <span style="font-size:23px;font-weight:bolder;color:#58B20D; font-family:pacifico;">
						    <span style="margin-right:3px;font-size:30px;">'.$traj->prix().'</span> DZD</span><br>

                           <small>par place</small>
                            </div>
                            <div style="padding:10px 40px 10px 40px;text-align:center;border-left:1px solid;">';
							 if($traj->nombre_place()==0)
							{echo '<span style="font-size:30px;font-weight:bolder; color:red;font-family:pacifico;">Complet</span><br>
							 ';} else {echo'
                             <span style="font-size:30px;font-weight:bolder; color:white;font-family:pacifico;">'.$traj->nombre_place().'</span><br>

                            <small>places restantes</small>';}echo'
                            </div>
                            </div>
                            <div style="padding:10px;">
					<form>
                    <select style="width:100%;color:black;padding:10px 15px 10px 15px;border-radius:5px;cursor:not-allowed;" disabled>
                    <option>1 place</option>
                    <option>2 places</option>
                    <option>3 places</option>
                    </select><br>

                    <input type="submit" value="Réserver" style="cursor:not-allowed;" disabled/>
                    </form>
                    </div>
					</div>
					<div style="margin-top:10px;border:1px solid;border-radius:5px;">
							<div style="border-bottom:1px solid white;padding:10px 15px 10px 15px;background-color:gray;color:white;">
                            Conducteur
                            </div>
                            <div style="padding:15px;">
                            <div style=" display: -webkit-flex;
    display: flex;border-bottom:1px solid;padding-bottom:7.5px;margin-bottom:7.5px">
                           <a style="cursor:pointer;" href="profil_conducteur.php?id='.$cond->id().'"> <img id="profil"src="profil_photo/'.$cond->photo().'" style="border-radius:100%;" width="70px" height="70px"/></a>
                            <div style="margin-left:20px;margin-top:10px;">
                            <strong>'.ucfirst($cond->prenom()).'</strong><br>
                            '.$age.' ans 
                            </div>
                            </div>
                            <div style="padding-top:5px;">
                            <strong>Véhicule</strong> <br>
							'.$voiture[0]->marque().'<br>
                            Couleur : '.$voiture[0]->couleur().'
                            </div>
                            </div>
					</div>

			</div>
		</div>
	</div>
</div>';
}

?>
 
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
