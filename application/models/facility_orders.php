<?php
/**
 * @author Kariuki
 */
class facility_orders extends Doctrine_Record {	
	public function setTableDefinition()
	{
		        $this->hasColumn('id', 'int');
				$this->hasColumn('order_date', 'date');
				$this->hasColumn('approval_date', 'date');
				$this->hasColumn('deliver_date', 'date');
				$this->hasColumn('deliver_date', 'date');
				$this->hasColumn('dispatch_update_date', 'date');
				$this->hasColumn('facility_code', 'int');
				$this->hasColumn('order_no', 'int');
				$this->hasColumn('workload', 'int');
				$this->hasColumn('bed_capacity', 'int');
				$this->hasColumn('kemsa_order_id', 'int');
				$this->hasColumn('order_total', 'varchar',100);
				$this->hasColumn('reciever_id', 'int');
				$this->hasColumn('drawing_rights', 'varchar',100);
				$this->hasColumn('reciever_id', 'int');
				$this->hasColumn('ordered_by', 'int');
				$this->hasColumn('approved_by', 'int');
				$this->hasColumn('dispatch_by', 'varchar',100);
				$this->hasColumn('warehouse', 'varchar',100);
				$this->hasColumn('source', 'int');
				$this->hasColumn('status', 'int');	
	}

	public function setUp() {
		$this -> setTableName('facility_orders');		
		
	}


    public static function get_facility_order_summary_count($facility_code=null,$district_id=null,$county_id=null){
$where_clause=isset($facility_code)? "f.facility_code=$facility_code ": (isset($district_id)? "d.id=$district_id ": "d.county=$county_id ") ;

 $orders = Doctrine_Manager::getInstance()->getCurrentConnection()
->fetchAll("SELECT  f_o_s.`status_desc` as status, count(f_o.`id`) as total from facilities f, districts d,facility_order_status f_o_s,
 facility_orders f_o where f.facility_code=f_o.facility_code and f.district=d.id and f_o.`status`= f_o_s.id and $where_clause");
  return $orders ;	    	
    }

	
	
	
}
