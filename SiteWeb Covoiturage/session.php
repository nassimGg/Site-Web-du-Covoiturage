<?php

	session_start();
	require_once ('Conducteurmanager.class.php');
	require_once ('Participantmanager.class.php');
	$session = new ParticipantManager();
	
	$session1 = new ConducteurManager();
	// if user session is not active(not loggedin) this page will help 'home.php and profile.php' to redirect to login page
	// put this file within secured pages that users (users can't access without login)
	
	if(!$session->is_loggedin() or !$session1->is_loggedin())
	{
		// session no set redirects to login page
		$session->redirect('index2.php');
		$session1->redirect('index2.php');
	}

