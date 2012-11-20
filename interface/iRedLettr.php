<?php
	interface IRedLettr{
		public function getInfoAboutDateParamOrToday($date = '');
		public function saveToLoggr($logToSave);
		public function getDataFromCacheOrFalse($date);
	}
?>