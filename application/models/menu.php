<?php

class Menu extends Doctrine_Record {
	public function setTableDefinition() {
		$this -> hasColumn('menu_text', 'varchar', 20);
		$this -> hasColumn('menu_url', 'varchar', 100);
		$this -> hasColumn('access_group', 'varchar', 100);
	}

	public function setUp() {
		$this -> setTableName('menu');
	}

	public static function getAll() {
		$query = Doctrine_Query::create() -> select("*") -> from("Menu");
		$menus = $query -> execute();
		return $menus;
	}

}
?>
