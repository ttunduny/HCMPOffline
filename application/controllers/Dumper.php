<?php 
/**
 * @author Karsan
 */
if (!defined('BASEPATH'))
	exit('No direct script access allowed');

class Dumper extends MY_Controller {

	function __construct() {
		parent::__construct();
		//this comment is for you nigga
		//erase it 
		//hahaha
		// $this->load->model('dumper_model','dumper_model');
	}

	public function dump_db($facility_code,$db){
		$this->create_core_tables($facility_code,$db);
	}

 
	// public function mysql_dump($facility_code) {
	//   ini_set('memory_limit', '-1');
 // 	  $database = 'hcmp_rtk';
 //      $query = '';
 
 //      $tables = @mysql_list_tables($database);

 //      while ($row = @mysql_fetch_row($tables)) { $table_list[] = $row[0]; }
 // 		echo "<pre>";print_r($table_list);die;
 //      for ($i = 0; $i < @count($table_list); $i++) {
 
 //         $results = mysql_query('DESCRIBE ' . $database . '.' . $table_list[$i]);
 
 //         $query .= 'DROP TABLE IF EXISTS `' . $database . '.' . $table_list[$i] . '`;' . lnbr;
 //         $query .= lnbr . 'CREATE TABLE `' . $database . '.' . $table_list[$i] . '` (' . lnbr;
 
 //         $tmp = '';
 
 //         while ($row = @mysql_fetch_assoc($results)) {
 
 //            $query .= '`' . $row['Field'] . '` ' . $row['Type'];
 
 //            if ($row['Null'] != 'YES') { $query .= ' NOT NULL'; }
 //            if ($row['Default'] != '') { $query .= ' DEFAULT \'' . $row['Default'] . '\''; }
 //            if ($row['Extra']) { $query .= ' ' . strtoupper($row['Extra']); }
 //            if ($row['Key'] == 'PRI') { $tmp = 'primary key(' . $row['Field'] . ')'; }
 
 //            $query .= ','. lnbr;
 
 //         }
 
 //         $query .= $tmp . lnbr . ');' . str_repeat(lnbr, 2);
 
 //         $results = mysql_query('SELECT * FROM ' . $database . '.' . $table_list[$i]);
 
 //         while ($row = @mysql_fetch_assoc($results)) {
 
 //            $query .= 'INSERT INTO `' . $database . '.' . $table_list[$i] .'` (';
 
 //            $data = Array();
 
 //            while (list($key, $value) = @each($row)) { $data['keys'][] = $key; $data['values'][] = addslashes($value); }
 
 //            $query .= join($data['keys'], ', ') . ')' . lnbr . 'VALUES (\'' . join($data['values'], '\', \'') . '\');' . lnbr;
 
 //         }
 
 //         $query .= str_repeat(lnbr, 2);
 
 //      }
 
 //      return $query;
 
 //   }

   
   public function create_core_tables($facility_code,$database=null){
   		$database = (isset($database)) ? $database : 'hcmp_rtk';
   		$mysqli = new mysqli("localhost", "root", "", "hcmp_rtk");
	   	 if (mysqli_connect_errno()) {
		    printf("Connect failed: %s", mysqli_connect_error());
		    exit();
		}
	  	ini_set('memory_limit', '-1');
   		$filename = $facility_code.'.sql';	
   		$header = "DROP DATABASE IF EXISTS `$database`;\n\nCREATE DATABASE `$database`;\n\nUSE `$database`\n\n;";
   		$query = '';
		$handle = fopen($filename, 'w');
		$core_tables = array('access_level','account_list','assignments','comments','commodities','commodity_category','commodity_division_details','commodity_source','commodity_source_other','commodity_sub_category','counties','county_drug_store_issues','county_drug_store_totals','county_drug_store_transaction_table','districts','drug_commodity_map','drug_store_issues','drug_store_totals','drug_store_transaction_table','email_listing','facilities','git_log','issue_type','menu','malaria_drugs','rca_county','recepients','sub_menu','service_points','redistribution_data','log','log_monitor','facility_order_status','facility_order_details_rejects','facility_order_details');



		$facility_specific_tables = array('facility_issues'=>'facility_code',
										  'commodity_source_other_prices'=>'facility_code',
										  'dispensing_stock_prices'=>'facility_code',
										  'facility_amc'=>'facility_code',
										  'facility_amc1'=>'facility_code',
										  'facility_stocks_temp'=>'facility_code',
										  'facility_transaction_table'=>'facility_code',
										  'facility_user_log'=>'facility_code',
										  'malaria_data'=>'facility_id',
										  'patient_details'=>'facility_code',
										  'reversals'=>'facility_code',
										  'rh_drugs_data'=>'facility_code',
										  'service_point_stocks'=>'facility_code',
										  'facility_evaluation'=>'facility_code',
										  'facility_impact_evaluation'=>'facility_code',
										  'facility_monthly_stock'=>'facility_code',
										  'facility_orders'=>'facility_code',
										  'facility_stock_out_tracker'=>'facility_code',
										  'user'=>'facility',
										  'tuberculosis_data'=>'facility_code',
										  'requisitions'=>'facility',
										  'facility_stock_out_tracker'=>'facility_code',
										  'facility_stocks'=>'facility_code');
		for ($i=0; $i <count($core_tables) ; $i++) { 
			$query .= $this->create_inserts1($core_tables[$i],null,$mysqli);
		}

		// foreach ($facility_specific_tables as $key => $value) {
		// 	$table_name = $key;
		// 	$where = "WHERE $value = '$facility_code'";
		// 	$query .= $this->create_inserts1($table_name,$where,$mysqli);
		// }
		$mysqli->close();//die();
		
		$final_output = $header.$query;
		fwrite($handle, $final_output);
		fclose($handle);

		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Length: ". filesize("$filename").";");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/octet-stream; "); 
		header("Content-Transfer-Encoding: binary");

		echo "$final_output";
   }
   public function create_inserts($table_name= null,$where=null)
   {
   	 $sql_create = "SHOW CREATE TABLE `$table_name`";   	 
   	 $result_raw = $this->db->query($sql_create);
   	 $result_create = $result_raw->result_array();
   	 $create_table = null;
   	 foreach ($result_create as $key => $value) {
   	 	$create_table = $value['Create Table'].";\n";
   	 }   	 
   	 $sql = "Select * FROM $table_name";
   	 $result = $this->db->query($sql)->result_array();   
   	 $fields_total = null;
     $inserts = '';
   	 $rows_total = null;   	 
   	 if(count($result)>0){
   	 	$fields = array_keys($result[0]);   	 	
   	 	$string = '';
		foreach ($fields as $key => $value) {
		    $string .= ",`$value`";
		}
		$string = substr($string, 1); // remove leading ","
		$fields_total = '('.$string.')';


		for ($i=0; $i <count($result) ; $i++) { 			
			$data = array_values($result[$i]);   	 	
	   	 	$values = '';
	   	 	$count = 0;
			foreach ($data as $keys => $row) {
				if ($count==0) {
			    	$values .= ",$row";						
				}else{
			    	$values .= ",`$row`";
			    }
			}
			$values = substr($values, 1); // remove leading ","
			$rows_total = '('.$values.');';
   	 		$inserts .= 'INSERT INTO '.$table_name.$fields_total.' VALUES '.$rows_total."\n";
		}

		
   	 }

   	 return $create_table.$inserts.';';

   }

   public function create_inserts1($table_name= null,$where=null,$mysqli)
   {
   	 
   	$condition = ($where!=null) ? $where : '' ;
	$sql_create = "SHOW CREATE TABLE `$table_name`";  

	$fields_total = null;
	$create_table = '';
    $inserts = '';
   	$rows_total = null;   	 
	if ($result = $mysqli->query($sql_create)) {
		$column_types_array = array();
		$sql_column_types = "SHOW COLUMNS FROM `$table_name`";
		if ($result_sql_columns = $mysqli->query($sql_column_types)) {
			$result_column_types = mysqli_fetch_all($result_sql_columns,MYSQLI_ASSOC);
			foreach ($result_column_types as $rows => $types) {
				$type = $types['Type'];
			    $column_types_array[] = $type;
			}
		}

		/* determine number of rows result set */
	    $row_cnt = $result->num_rows;
	    $result_create = $result->fetch_array(MYSQLI_ASSOC);
	    $create_table = $result_create['Create Table'].";\n\n";	   
	    $sql = "select distinct * FROM $table_name  $condition";	
	    if ($result_sql = $mysqli->query($sql)) {
	    	// $result_fields = $result_sql->mysqli_fetch_all(MYSQLI_ASSOC);
	    	$result_fields = mysqli_fetch_all($result_sql,MYSQLI_ASSOC);				
	    	 if(count($result_fields)>0){
		   	 	$fields = array_keys($result_fields[0]); 
		   	 	$string = '';
				foreach ($fields as $key => $value) {
				    $string .= ",`$value`";
				}
				$string = substr($string, 1); // remove leading ","
				$fields_total = '('.$string.')';


				for ($i=0; $i <count($result_fields) ; $i++) { 			
					$data = array_values($result_fields[$i]);   
					// echo "<pre>";print_r($data);die;		 	
			   	 	$values = '';
			   	 	$count = 0;
					foreach ($data as $keys => $row) {
						$row_types = $column_types_array[$keys];

						if (strpos($row_types, 'int') !== false) {
						    $values .= ",$row";				
						}else{
							$row = addslashes($row);
					    	$values .= ",'$row'";
						}
						// if ($count==0) {							
					 //    	$values .= ",$row";						
						// }else{
						// 	$row = addslashes($row);
					 //    	$values .= ",'$row'";
					 //    }
					    // $count++;
					}
					$values = substr($values, 1); // remove leading ","
					$rows_total = '('.$values.');';
		   	 		$inserts .= 'INSERT INTO '.$table_name.$fields_total.' VALUES '.$rows_total."\n";
				}

				
		   	 }
	    }

	    /* close result set */
	    $result->close();
	}
   	 return $create_table.$inserts;

   }

 //   public function get_fields($table_name = null){
 //   	 $sql = "Select * FROM access_level";
 //   	 $result = $this->db->query($sql)->result_array();   
 //   	 $fields_total = null;
 //   	 if(count($result)>0){
 //   	 	$fields = array_keys($result[0]);
 //   	 	// echo "<pre>";print_r($fields);die;
 //   	 	$string = '';
	// 	foreach ($fields as $key => $value) {
	// 	    $string .= ",$value";
	// 	}
	// 	$string = substr($string, 1); // remove leading ","
	// 	$fields_total = '('.$string.')';
 //   	 }	 
 //   	 echo "$fields_total";die;
 //   	 return $fields_total;
 //   }

 //   public function get_data($table_name = null){
 //   	 $sql = "Select * FROM access_level";
 //   	 $result = $this->db->query($sql)->result_array();   
 //   	 $fields_total = null;
 //   	 if(count($result)>0){
 //   	 	$fields = array_values($result[0]);   	 	
 //   	 	$string = '';
	// 	foreach ($fields as $key => $value) {
	// 	    $string .= ",`$value`";
	// 	}
	// 	$string = substr($string, 1); // remove leading ","
	// 	$fields_total = '('.$string.')';
 //   	 }	 
 //   	 echo "$fields_total";die;
 //   	 return $fields_total;
 //   }
 //   public function show_insert(){
 //   	 $sql = "Select * FROM access_level";
 //   	 $result = $this->db->query($sql)->result_array();   	 
 //   	 for ($i=0; $i < count($result); $i++) {    	 	
 //   	 	$fields = array_keys($result[$i]);
 //   	 	$string = '';
	// 	foreach ($fields as $key => $value) {
	// 	    $string .= ",$value";
	// 	}
	// 	$string = substr($string, 1); // remove leading ","
	// 	$fields = '('.$string.')';
   	 	

 //   	 }
 //   	 foreach ($variable as $key => $value) {
 //   	 	# code...
 //   	 }
 //   	 echo "<pre>";print_r($result);die;
 //   }
 //   public function dump_test(){
 //   	$sql = "SHOW TABLES";
	// // connect_db();
	// $retval = $this->db->query($sql);
	// echo "<pre>";print_r($retval);die;
	// if(! $retval )
	// {
	//   die('Could not retrive tables: ' . mysql_error());
	// }else{
	// 	while($row = mysql_fetch_array($retval)){
	// 		$tables[] = $row[0];
	// 	}
	// }
	// $starttime = microtime(true);
	// $headers = "-- MySql Data Dump\n\n";
	// $headers .= "-- Database : " . db_name . "\n\n";
	// $headers .= "-- Dumping started at : ". date("Y-m-d-h-i-s") .  "\n\n";

	// for($t=0;$t<3;$t++){
	// 	$outputdata .= "\n\n-- Dumping data for table : $tables[$t]\n\n";
	// 	$sql = "SELECT * FROM $tables[$t]";
	// 	$result = mysql_query($sql);
	// 	while($row = mysql_fetch_assoc($result)){
	// 		$nor = count($row);
	// 		$datas = array();
	// 		foreach($row as $r){
	// 			$datas[] = $r;
	// 		}
	// 		$lines .= "INSERT INTO $tables[$t] VALUES (";
	// 		for($i=0;$i<$nor;$i++){
	// 			if($datas[$i]===NULL){
	// 				$lines .= "NULL";
	// 			}else if((string)$datas[$i] == "0"){
	// 				$lines .= "0";
	// 			}else if(filter_var($datas[$i],FILTER_VALIDATE_INT) || filter_var($datas[$i],FILTER_VALIDATE_FLOAT)){
	// 				$lines .= $datas[$i];
	// 			}else{
	// 				$lines .= "'" . str_replace("\n","\\n",$datas[$i]) . "'";
	// 			}
	// 			if($i==$nor-1){
	// 				$lines .= ");\n";
	// 			}else{
	// 				$lines .= ",";
	// 			}
	// 		}
	// 		$outputdata .= $lines;
	// 		$lines = "";
	// 	}
	// }
	// $headers .= "-- Dumping finished at : ". date("Y-m-d-h-i-s") .  "\n\n";
	// $endtime = microtime(true);
	// $diff = $endtime - $starttime;
	// $headers .= "-- Dumping data of $db_name took : ". $diff .  " Sec\n\n";
	// $headers .= "-- --------------------------------------------------------";
	// $datadump = $headers . $outputdata;

	// $file = fopen($backupFile,"w");
	// $len = fwrite($file,$datadump);
	// fclose($file);
	// if($len != 0){
	// 	return true;
	// }else{
	// 	return false;
	// }
 //   }
 //   public function mysql_dump1($facility_code) {
	//   ini_set('memory_limit', '-1');
 // 	  $database = 'hcmp_rtk';
 //      $query = '';
 
 //      $tables = @mysql_list_tables($database);

 //      $query .= "DROP TABLE IF EXISTS ` $database.user`;\n";
 //         $query .= "\n" . 'CREATE TABLE `' . $database . '.user` ('."\n";
 
 //         $tmp = ''; 
         
 
 //         $results = mysql_query('SELECT * FROM ' . $database . '.user where facility=' . $facility_code);
 
 //         while ($row = @mysql_fetch_assoc($results)) {
 
 //            $query .= 'INSERT INTO `' . $database . '.user` (';
 
 //            $data = Array();
 
 //            while (list($key, $value) = @each($row)) { $databaseata['keys'][] = $key; $data['values'][] = addslashes($value); }
 
 //            $query .= join($data['keys'], ', ') . ')' . "\n" . 'VALUES (\'' . join($data['values'], '\', \'') . '\');' . "\n";
 
 //         }
 
 //         $query .= str_repeat("\n", 2);
 
 //      	// echo "<pre>";print_r($query);
 //    	$filename = 'test.sql';		
	// 	!$handle = fopen($filename, 'w');
	// 	fwrite($handle, $query);
	// 	fclose($handle);


	// 	header("Cache-Control: public");
	// 	header("Content-Description: File Transfer");
	// 	header("Content-Length: ". filesize("$filename").";");
	// 	header("Content-Disposition: attachment; filename=$filename");
	// 	header("Content-Type: application/octet-stream; "); 
	// 	header("Content-Transfer-Encoding: binary");

	// 	echo "$query";
 
 //      // return $query;
 
 //   }
 

}

 ?>