<?php
namespace rlInternal{

require_once(dirname(__FILE__) . '/../interface/iRedLettr.php');
require_once(dirname(__FILE__) . '/../persistent_storage/redLettrStorage.php');
require_once(dirname(__FILE__) . '/../models/Day.php');

class redLettrInternal implements \rlInterface\iRedLettr{
	//Private members
	private $url = 'http://api.dryg.net/dagar/v1/';
	private $dateQuery = "?datum=";
	private $errors = "errors";
	private $acceptJson = array("Accept" => "application/json");
	const REMOTEAPIERROR = "Error in remote API";
	
	private $db;
	
	public function __construct(){
		//$this->db = new \rlStorage\RedLettrStorage();
	}

	public function getInfoAboutDateParamOrToday(\DateTime $date = NULL){
		$ret;
		
		if($date == NULL){
			$ret = $this->curlIO($this->url);
		}else{	
			$ret = $this->curlIO($this->url . $this->dateQuery . $date->format('Ymd'));
		}
		//$this->db->add($ret);
		if($ret){
			$day = new \rlModels\Day();
			$day = $day->create($ret->datum, $ret->unixdatum, $ret->dag, $ret->veckodag, $ret->vecka, $ret->helgdag);
			$ret = $day;
		}
		return $ret;
	}	

	public function getInfoAboutDateFromTo($date_from, $date_to){
		throw new NotImplementedException("Not implemented");
		//$Date = date('Y-m-d');
		//date('Y-m-d', strtotime($Date. ' + 2 days'));
	}
	
	public function getInfoAboutDatesInWeek($weekNumber){
		throw new NotImplementedException("Not implemented");
	}
	
	public function saveToLoggr($logToSave){
		throw new NotImplementedException("Not implemented");
	}

	public function getDataFromCacheOrFalse($date){
		throw new NotImplementedException("Not implemented");
	}

	private function curlIO($url){
		$ret = '';
		
		$ch = curl_init();
		
		curl_setopt($ch, CURLOPT_URL, $url);
		curl_setopt($ch, CURLOPT_HTTPHEADER, $this->acceptJson);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		$output = curl_exec($ch);
		
		if(!$output){
			throw new RedLettrException(redLettr::REMOTEAPIERROR);
		}else{
			$ret = $output;
		}
		
		curl_close($ch);
		return json_decode($ret);
	}
}

class RedLettrException extends \Exception{
	public function __construct($message, $code = 0, Exception $previous = null){
		parent::__construct($message, $code, $previous);
	}
}

class NotImplementedException extends \BadMethodCallException{
	public function __construct($message, $code = 0, Exception $previous = null){
		parent::__construct($message, $code, $previous);
	}	
}
}
