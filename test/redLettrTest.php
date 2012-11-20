<?php
	require_once(dirname(__FILE__) . '/simpletest/autorun.php');
	require_once(dirname(__FILE__) . '/../redLettr.php');

	class redLettrTester extends UnitTestCase{

		function __construct(){
			$this->redLettr = new redLettr();
		}

		function TestFirstLogMessageCreatesFileIfNonExistent(){
			$this->assertFalse(file_exists(dirname(__FILE__) . '/../log/log.php'));
			$this->redLettr->saveToLoggr('Message to save.');
			$this->assertTrue(file_exists(dirname(__FILE__) . '/../log/log.php'));
		}

		function TestObjectIsRetrived(){
			$this->assertTrue(is_object($this->redLettr->getInfoAboutDateParamOrToday()));
		}

		function TestDataIsTodayIfNoParam(){
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday()->datum === date("YYYY-mm-dd"));
		}

		function TestIfParamDate(){
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday("20121114")->datum != date("YYYY-mm-dd"));
		}

		function TestIfArrayIsReturnedFromDateFromTo(){
			$this->assertTrue($this->redLettr->getInfoAboutDateFromTo("20120101", "20121230"));
		}

		function TestIfAllDatesIsInWeekNumber(){
			var $week = 12;
			var dates = $this->redLettr->getInfoAboutDatesInWeek();
			foreach ($dates as $value) {
				$this->assertTrue($value.vecka === 12)
			}
		}
	}
?>