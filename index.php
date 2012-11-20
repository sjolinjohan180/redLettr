<?php
	require_once(dirname(__FILE__) . '/redLettr.php');

	$rl = new redLettr();
	try{
		$dateInfo = $rl->getInfoAboutDateParamOrToday('20120112');
		if(isset($dateInfo->errors)){
			var_dump($dateInfo->errors);
		}else{
			var_dump($dateInfo);
		}
	}catch(redLettrException $e){
		echo("Fel har skett:".$e);
	}
?>