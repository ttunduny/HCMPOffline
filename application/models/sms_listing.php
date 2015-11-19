<?php
class Sms_listing extends Doctrine_Record {
/////
	public function setTableDefinition() {
		$this->hasColumn('id', 'int');
		$this->hasColumn('description', 'varchar', 45);
		$this->hasColumn('type', 'varchar', 45);
		$this->hasColumn('last_sent', 'timestamp');
		$this->hasColumn('status', 'int');
		
		
	}
	
	public function setUp() {
		$this->setTableName('sms_listing');
		
	}

	public static function get_last_run() {		
		$query = Doctrine_Query::create() -> select("*") -> from("sms_listing");
		$data = $query -> execute();
		return $data;
			
	}
	
	
}
