<?php
	require_once(dirname(__FILE__) . '/interface/iRedLettr.php');
	require_once(dirname(__FILE__) . '/internal/redLettrInternal.php');
	class RedLettr implements \rlInterface\iRedLettr{

		private $internal;

		public function __construct(){
			$this->internal = new \rlInternal\RedLettrInternal();
		}

		public function getInfoAboutDateParamOrToday(\DateTime $date = NULL){
			return $this->internal->getInfoAboutDateParamOrToday($date);
		}

		public function getInfoAboutDateFromTo($date_from, $date_to){
			//$Date = date('Y-m-d');
			//date('Y-m-d', strtotime($Date. ' + 2 days'));
		}
		
		public function getInfoAboutDatesInWeek($weekNumber){
		
		}
	}

?>