<?php
	require_once(dirname(__FILE__) . '/simpletest/autorun.php');
	require_once(dirname(__FILE__) . '/../redLettr.php');

	class LogTester extends UnitTestCase{

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
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday()->date == date("Y-m-d H:i:s"));
		}

		function TestIfParamDate(){
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday("2212-11-14 22:23:31")->date != date("Y-m-d H:i:s"));
		}
	}
?>