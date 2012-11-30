<?php
namespace rlStorage{
class redLettrStorage{

	const LOCATION = "sqlite:redLettr.sqlite3";
	private $db_table_prefix = "prod_";
	private $db_file;
	
	public function __construct(){
		$this->db_file = new \PDO(redLettrStorage::LOCATION);
		$this->db_file->setAttribute(\PDO::ATTR_ERRMODE,
									\PDO::ERRMODE_EXCEPTION);
		$this->createTable();
	}

	public function add($a_date){
		$query = "INSERT INTO ".$this->db_table_prefix."redLettr
					VALUES (:id, :unix_date, :day_number, :week_number, :day_of_week, :red_letter_day, :red_lettr_name)";
		$stmt = $this->db_file->prepare($query);

		var_dump($a_date);

		$stmt->bindParam(':unix_date', $unixdatum);
		$stmt->bindParam(':day_number', $veckodag);
		$stmt->bindParam(':week_number', $vecka);
		$stmt->bindParam(':day_of_week', $dag);
		$stmt->bindParam(':red_letter_day', $is_helgdag);
		$stmt->bindParam(':red_lettr_name', $helgdag);

		$is_red_lettr = isset($a_date->helgdag);

		$unixdatum = $a_date->unixdatum;
		$veckodag = $a_date->veckodag;
		$vecka = $a_date->vecka;
		$dag = $a_date->dag;
		$is_helgdag = isset($a_date->helgdag);
		if($is_red_lettr){
			$helgdag = $a_date->helgdag;
		}else{
			$helgdag = NULL;
		}
		
		try{
			$result = $stmt->execute();	
		}catch(PDOException $e){
			return FALSE;
		}
	}

	public function addBulk($a_dates){

	}

	public function getAll(){
		
	}

	public function getById($a_date_id){
		
	}

	public function getByDate(Datetime $a_date){
		
	}

	public function getByWeek($a_week_number){
		
	}

	public function getAllInYear($a_year){

	}

	public function getDatesFromTo(DateTime $a_date_from, Datetime $a_date_to){
		
	}

	private function createTable(){

		$this->db_file->exec("CREATE TABLE IF NOT EXISTS ".$this->db_table_prefix."redLettr
								(id INTEGER PRIMARY KEY,
								unix_date INTEGER UNIQUE,
								day_number INTEGER,
								week_number INTEGER,
								day_of_week TEXT,
								red_letter_day BOOLEAN,
								red_lettr_name TEXT)");
	}

}
}