<?php 
class Tb_data extends Doctrine_Record 
{

public static function get_facility_name($facility_code){
	$query = Doctrine_Query::create() -> select("*") -> from("facilities")->where("facility_code='$facility_code'");
	$result = $query -> execute(array(), Doctrine::HYDRATE_ARRAY);
	return $result[0];
}

public static function save_tb_data($val){
	$return = "this is a test";
	/*foreach ($val as $key => $value) {
	echo "<pre>";
	print_r($value);
	echo "</pre>";
	}
	*/
	

	$query = Doctrine_Query::create() 
	->insert('tuberculosis_data')
	->values(
		array(
			'id' => null,
			'facility_code'=>$facility_code,
		    'beginning_date'=>$a1
			)
		);
	echo "Sucess";
	return $val;
}

}
/*

INSERT INTO `hcmp`.`tuberculosis_data` (`id`, `facility_id`, `beginning_date`, `currently_recieved`, `ending_date`, `beginning_balance`, `quantity_dispensed`, `positive_adjustment`, `negative_adjustment`, `losses`, `physical_count`, `earliest_expiry`, `quantity_needed`) VALUES (NULL, '12864', '2014-06-03', '300', '2014-06-11', '1000', '670', '10', '10', '100', '330', '2014-06-12', '150')

*/

 ?>
