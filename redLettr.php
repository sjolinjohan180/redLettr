<?php
	require_once(dirname(__FILE__) . '/interface/iRedLettr.php');
	class redLettr implements iRedLettr{
		
		private $url = 'http://api.dryg.net/dagar/v1/';

		public function getInfoAboutDateParamOrToday($date = ''){
			$ret = '';
			
			if($date == ''){
				$ret = $this->curlIO($this->url);
			}else{
				$ret = $this->curlIO($this->url."?datum=$date");
			}
			return $ret;
		}

		public function getInfoAboutDateFromTo($date_from, $date_to){
		}
		
		public function getInfoAboutDatesInWeek($weekNumber){
		}
		
		public function saveToLoggr($logToSave){
		}

		public function getDataFromCacheOrFalse($date){

		}

		private function curlIO($url){
			$ret = '';
			
			$ch = curl_init();
			
			curl_setopt($ch, CURLOPT_URL, $url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, array("Accept" => "application/json"));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$output = curl_exec($ch);
			
			if(!$output){
				throw new RedLettrException("No data found.");
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
?>