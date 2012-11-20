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
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday()->datum === date("Y-m-d"));
		}

		function TestIfParamDate(){
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday("20121114")->datum !== date("Y-m-d"));
		}

		function TestIfArrayIsReturnedFromDateFromTo(){
			$this->assertTrue(is_array($this->redLettr->getInfoAboutDateFromTo("20120101", "20121230")));
		}

		function TestIfAllDatesIsInWeekNumber(){
			$week = 12;
			$dates = $this->redLettr->getInfoAboutDatesInWeek($week);
			foreach ($dates as $value) {
				$this->assertTrue($value->vecka === $week);
			}
		}

		function TestIfNoErrorsWhenDateIsValid(){
			$dateInfo = $this->redLettr->getInfoAboutDateParamOrToday("20121114");
			$this->assertTrue(!isset($dateInfo->errors));
		}

		function TestIfDataIsReturnedFromCache(){
			$dateInfo = $this->redLettr->getInfoAboutDateParamOrToday("20121114");
			$dateFromCacheInfo = $this->redLettr->getDataFromCacheOrFalse("20121114");
			$this->assertEqual($dateFromCacheInfo, $dateInfo);
				
		}

		// Test to fail

		function TestIfErrorWhenDateIsNotValid(){
			$dateInfo = $this->redLettr->getInfoAboutDateParamOrToday("This is not a valid date");
			$this->assertTrue(isset($dateInfo->errors));
		}
	}
?>