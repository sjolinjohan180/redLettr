<?php
	require_once(dirname(__FILE__) . '/redLettr.php');

	$rl = new redLettr();
	try{
		var_dump($rl->getInfoAboutDateParamOrToday('20121224'));
	}catch(redLettrException $e){
		echo("Fel har skett:".$e);
	}
?>