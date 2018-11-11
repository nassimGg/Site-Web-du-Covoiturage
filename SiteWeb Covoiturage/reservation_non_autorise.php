<?php 
session_start();

require_once ('dbconfig.php');
require_once ('Conducteurmanager.class.php');
require_once ('Conducteur.class.php');
require_once ('Administrateurmanager.class.php');
require_once ('Administrateur.class.php');
$managerc=new ConducteurManager();
$managera=new AdministrateurManager();




?>

<!DOCTYPE html>
<html lang="en-US">
<head>
<meta charset="utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<?php
if($managera->is_loggedin())
{
 echo '<meta http-equiv="refresh" content="5;URL=/ProjetFinEtude/admin.php">';
}
elseif ($managerc->is_loggedin())
{echo '<meta http-equiv="refresh" content="5;URL=/ProjetFinEtude/index_profil_conducteur.php">';
}
?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">


<title>ETU Covoiturage</title>
<link rel="icon" type="images/png" href="images/title.gif"/>

</head>
<body style="background-image:url(images/back_reserv.png);background-size:cover;width:99%;height:100%;background-repeat:no-repeat;">

<img src="images/reserv_non_autorisé.png" style="margin-left:250px;margin-top:50px;"/>';



</body>
</html>
