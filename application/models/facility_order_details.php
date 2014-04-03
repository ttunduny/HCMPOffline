<?php
/**
 * @author Kariuki
 */
class facility_order_details extends Doctrine_Record {	
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('order_number_id', 'int');
				$this->hasColumn('commodity_id', 'int');
				$this->hasColumn('quantity_ordered', 'int');
				$this->hasColumn('quantity_recieved', 'int');
				$this->hasColumn('price', 'int');
				$this->hasColumn('o_balance', 'int');
				$this->hasColumn('t_receipts', 'int');
				$this->hasColumn('t_issues', 'int');
				$this->hasColumn('adjustpve', 'int');
				$this->hasColumn('adjustnve', 'int');
				$this->hasColumn('losses', 'int');
				$this->hasColumn('days', 'int');
				$this->hasColumn('comment', 'varchar',100);
				$this->hasColumn('s_quantity', 'int');
				$this->hasColumn('amc', 'int');
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('facility_order_details');		
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
	}

	
	
	
}
