<?php
class Git_updater_model extends Doctrine_Record {
	public  function get_latest_hash(){
		$latest_commit = $this->db->query("SELECT * FROM hcmp_rtk.git_log WHERE update_time = (SELECT MAX(update_time) from git_log)");

		return $latest_commit->result_array();
	}
}
?>