<?php
class Log_monitor extends Doctrine_Record {
/////
	public function setTableDefinition() {
		$this->hasColumn('user_id', 'integer', 11);
		$this->hasColumn('log_timestamp', 'timestamp');
		$this->hasColumn('log_activity', 'int', 11);
		$this->hasColumn('forgetpw_code', 'varchar', 255);
			
		
	}
	
	public function setUp() {
		$this->setTableName('Log_monitor');
		
	}

	public static function getlogactivity() {
		
		$query = Doctrine_Query::create() -> select("*") -> from("Log_monitor");
		$data = $query -> execute();
		return $data;
			
	}

	public static function check_code_exist($code,$user_id) {
		
		$query = Doctrine_Query::create() -> select("*") -> from("Log_monitor") -> where("user_id ='$user_id' AND forgetpw_code='$code'");
		$data = $query -> execute();
		return $data;
			
	}
	
	
}
