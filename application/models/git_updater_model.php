<?php
class Git_updater_model extends Doctrine_Record {
<<<<<<< HEAD
	public  function get_latest_hash(){
		$latest_commit = $this->db->query("SELECT * FROM hcmp_rtk.git_log WHERE update_time = (SELECT MAX(update_time) from git_log)");

		return $latest_commit->result_array();
	}
}
?>
=======
	public function get_latest_hash(){
		$latest_hash = $this->db->query('SELECT * FROM git_log WHERE date_added = (SELECT MAX(date_added) FROM git_log)');

		$res = $latest_hash->result_array();
		// return = $res[0]['date_added']
	}
	

}
>>>>>>> cfaed47d0f5f3941855efdacade5afb4237ab353
