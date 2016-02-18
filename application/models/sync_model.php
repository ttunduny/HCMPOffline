<?php
class Sync_model extends Doctrine_Record {
	public function get_latest_timestamp(){
		$query = $this->db->query("SELECT * FROM sync_data WHERE last_sync_date=(SELECT MAX(last_sync_date) FROM sync_data)");
		$result = $query->result_array();
		return $result;
	}
}
?>