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
				$this->hasColumn('quantity_ordered_pack', 'int');
				$this->hasColumn('quantity_ordered_unit', 'int');
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
				$this->hasColumn('c_stock', 'int');
				$this->hasColumn('amc', 'int');
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('facility_order_details');		
		$this -> hasMany('commodities as commodity_detail', array('local' => 'commodity_id', 'foreign' => 'id'));
		
	}
	////dumbing data into the issues table
	public static function update_facility_order_details_table($data_array){
		$o = new facility_order_details();
	    $o->fromArray($data_array);
		$o->save();
		return TRUE;
	}

	
	
	
}
