<?php
	interface IRedLettr{
		public function getInfoAboutDateParamOrToday($date = '');
		/**
			TODO: Future ideas to get dates in a certain range or a certain week.
		*/
		public function getInfoAboutDateFromTo($date_from, $date_to);
		public function getInfoAboutDatesInWeek($weekNumber);
		public function saveToLoggr($logToSave);
		public function getDataFromCacheOrFalse($date);
	}
?>