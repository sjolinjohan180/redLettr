<?php
namespace rlModels{
	class Day{
		public $date;
		public $unix;
		public $dayName;
		public $weekDay;
		public $week;
		public $redLettr;

		public function create($a_date, $a_unix, $a_dayName, $a_weekDay, $a_week, $a_redLettr){
			$day = new Day();

			$day->date = $a_date;
			$day->unix = $a_unix;
			$day->dayName = $a_dayName;
			$day->weekDay = $a_weekDay;
			$day->week = $a_week;
			$day->redLettr = $a_redLettr;

			return $day;
		}

	}
}
?>