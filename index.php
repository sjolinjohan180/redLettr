<?php
	require_once(dirname(__FILE__) . '/redLettr.php');
	date_default_timezone_set("Europe/Stockholm");
	$rl = new RedLettr();
	try{
		$dateInfo = $rl->getInfoAboutDateParamOrToday(new DateTime('abc'));
		if(isset($dateInfo->errors)){
			var_dump($dateInfo->errors);
		}else{
			var_dump($dateInfo);
		}
	}catch(redLettrException $e){
		echo("Fel har skett:".$e);
	}
?>