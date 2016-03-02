<?php
class Git_updater_model extends Doctrine_Record {

	public function get_latest_hash(){
		$latest_hash = $this->db->query('SELECT * FROM git_log WHERE date_added = (SELECT MAX(date_added) FROM git_log)');

		$res = $latest_hash->result_array();
		// return = $res[0]['date_added']
	}
	

}
