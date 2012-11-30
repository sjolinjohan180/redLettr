<?php
namespace rlInterface{

	interface IRedLettr{
		public function getInfoAboutDateParamOrToday(\DateTime $date = NULL);
		/**
			TODO: Future ideas to get dates in a certain range or a certain week.
		*/
		public function getInfoAboutDateFromTo($date_from, $date_to);
		public function getInfoAboutDatesInWeek($weekNumber);
	}

}
?>