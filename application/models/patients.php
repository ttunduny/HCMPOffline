<?php
/*
@author Karsan
*/
class Patients extends Doctrine_Record {
	public function get_all(){
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT * from patients
			");

		return $query;
	}

	public function get_patient_details($id = NULL){
		$magufuli = isset($id)? "p.id = $id":NULL;

		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT 
				p.id,
			    p.patient_names,
			    p.age
			FROM
			    patients p
			WHERE
			    $magufuli
			    GROUP BY id
			");

		return $query;
	}

	public function get_patient_commodity_info($id = NULL){
		$magufuli = isset($id)? "AND p.id = $id":NULL;
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT 
			    c.commodity_code,
			    p.patient_names,
			    c.commodity_name,
			    c.unit_size,
			    c.total_commodity_units,
			    i.issue_type_desc,
			    p.id,
			    p.age,
			    pi.amount,
			    pi.date_issued
			FROM
			    commodities c,
			    patients p,
			    patient_issues pi,
			    issue_type i
			WHERE
			    p.id = pi.patient_id
			        AND pi.commodity_id = c.id
			        AND i.id = pi.issue_type_id
			        $magufuli
			");

		return $query;
	}

	public function get_patient_data($patient_id){
		$dawa_sawa = isset($patient_id)? "WHERE id = $patient_id":NULL;
		$query = Doctrine_Manager::getInstance()->getCurrentConnection()->fetchAll("
			SELECT * FROM patients $dawa_sawa
			");

		return $query;
	}

}
?>