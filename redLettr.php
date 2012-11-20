<?php
	require_once(dirname(__FILE__) . '/interface/iRedLettr.php');
	class redLettr implements iRedLettr{
		//Private members
		private $url = 'http://api.dryg.net/dagar/v1/';
		private $dateQuery = "?datum=";
		private $errors = "errors";
		private $acceptJson = array("Accept" => "application/json");
		const REMOTEAPIERROR = "Error in remote API";

		public function getInfoAboutDateParamOrToday($date = ''){
			$ret = '';
			
			if($date == ''){
				$ret = $this->curlIO($this->url);
			}else{
				$validDate = date_parse($date);
				if(count($validDate[$this->errors]) !== 0){
					$ret = new stdClass();
					$ret->errors = $validDate[$this->errors];
				}else{
					$ret = $this->curlIO($this->url . $this->dateQuery . $date);
				}
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

	class RedLettrException extends Exception{
		public function __construct($message, $code = 0, Exception $previous = null){
			parent::__construct($message, $code, $previous);
		}
	}

	class NotImplementedException extends BadMethodCallException{
		public function __construct($message, $code = 0, Exception $previous = null){
			parent::__construct($message, $code, $previous);
		}	
	}

?>