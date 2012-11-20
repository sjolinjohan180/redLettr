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
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday()->datum == date("YYYYmmdd"));
		}

		function TestIfParamDate(){
			$this->assertTrue($this->redLettr->getInfoAboutDateParamOrToday("22121114")->datum != date("YYYYmmdd"));
		}
	}
?>