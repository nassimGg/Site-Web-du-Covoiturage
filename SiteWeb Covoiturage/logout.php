<?php
	session_start();
	require_once('Participantmanager.class.php');
	require_once('Conducteurmanager.class.php');
	require_once('Administrateurmanager.class.php');
	$user_logout = new ParticipantManager();
	$user_logout1 = new ConducteurManager();
	$user_logout2 = new AdministrateurManager();	
	
	
		$user_logout->logout();
		$user_logout->redirect('index2.php');
		$user_logout1->logout();
		$user_logout1->redirect('index2.php');
		$user_logout2->logout();
		$user_logout2->redirect('index2.php');
	
?>