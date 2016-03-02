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
	}

	public function dump_db($facility_code){

	}

 
	public function mysql_dump($facility_code) {
	  ini_set('memory_limit', '-1');
 	  $database = 'hcmp_rtk';
      $query = '';
 
      $tables = @mysql_list_tables($database);

      while ($row = @mysql_fetch_row($tables)) { $table_list[] = $row[0]; }
 		echo "<pre>";print_r($table_list);die;
      for ($i = 0; $i < @count($table_list); $i++) {
 
         $results = mysql_query('DESCRIBE ' . $database . '.' . $table_list[$i]);
 
         $query .= 'DROP TABLE IF EXISTS `' . $database . '.' . $table_list[$i] . '`;' . lnbr;
         $query .= lnbr . 'CREATE TABLE `' . $database . '.' . $table_list[$i] . '` (' . lnbr;
 
         $tmp = '';
 
         while ($row = @mysql_fetch_assoc($results)) {
 
            $query .= '`' . $row['Field'] . '` ' . $row['Type'];
 
            if ($row['Null'] != 'YES') { $query .= ' NOT NULL'; }
            if ($row['Default'] != '') { $query .= ' DEFAULT \'' . $row['Default'] . '\''; }
            if ($row['Extra']) { $query .= ' ' . strtoupper($row['Extra']); }
            if ($row['Key'] == 'PRI') { $tmp = 'primary key(' . $row['Field'] . ')'; }
 
            $query .= ','. lnbr;
 
         }
 
         $query .= $tmp . lnbr . ');' . str_repeat(lnbr, 2);
 
         $results = mysql_query('SELECT * FROM ' . $database . '.' . $table_list[$i]);
 
         while ($row = @mysql_fetch_assoc($results)) {
 
            $query .= 'INSERT INTO `' . $database . '.' . $table_list[$i] .'` (';
 
            $data = Array();
 
            while (list($key, $value) = @each($row)) { $data['keys'][] = $key; $data['values'][] = addslashes($value); }
 
            $query .= join($data['keys'], ', ') . ')' . lnbr . 'VALUES (\'' . join($data['values'], '\', \'') . '\');' . lnbr;
 
         }
 
         $query .= str_repeat(lnbr, 2);
 
      }
 
      return $query;
 
   }

   public function show_table(){
   	 $sql = "SHOW CREATE TABLE access_level";
   	 $result = $this->db->query($sql)->result_array();
   	 echo "<pre>";print_r($result);die;

   }


   public function create_inserts($table_name= null)
   {
   	 $sql = "Select * FROM $table_name";
   	 $result = $this->db->query($sql)->result_array();   
   	 $fields_total = null;
   	 $rows_total = null;   	 
   	 if(count($result)>0){
   	 	$inserts = '';
   	 	$fields = array_keys($result[0]);   	 	
   	 	$string = '';
		foreach ($fields as $key => $value) {
		    $string .= ",$value";
		}
		$string = substr($string, 1); // remove leading ","
		$fields_total = '('.$string.')';


		for ($i=0; $i <count($result) ; $i++) { 			
			$data = array_values($result[$i]);   	 	
	   	 	$values = '';
			foreach ($data as $keys => $row) {
			    $values .= ",`$row`";
			}
			$values = substr($values, 1); // remove leading ","
			$rows_total = '('.$values.')';
   	 		$inserts .= 'INSERT INTO '.$table_name.$fields_total.' VALUES '.$rows_total.";\n";
		}

		echo "$inserts";die;
   	 }




   }


   public function get_fields($table_name = null){
   	 $sql = "Select * FROM access_level";
   	 $result = $this->db->query($sql)->result_array();   
   	 $fields_total = null;
   	 if(count($result)>0){
   	 	$fields = array_keys($result[0]);
   	 	// echo "<pre>";print_r($fields);die;
   	 	$string = '';
		foreach ($fields as $key => $value) {
		    $string .= ",$value";
		}
		$string = substr($string, 1); // remove leading ","
		$fields_total = '('.$string.')';
   	 }	 
   	 echo "$fields_total";die;
   	 return $fields_total;
   }

   public function get_data($table_name = null){
   	 $sql = "Select * FROM access_level";
   	 $result = $this->db->query($sql)->result_array();   
   	 $fields_total = null;
   	 if(count($result)>0){
   	 	$fields = array_values($result[0]);   	 	
   	 	$string = '';
		foreach ($fields as $key => $value) {
		    $string .= ",`$value`";
		}
		$string = substr($string, 1); // remove leading ","
		$fields_total = '('.$string.')';
   	 }	 
   	 echo "$fields_total";die;
   	 return $fields_total;
   }
   public function show_insert(){
   	 $sql = "Select * FROM access_level";
   	 $result = $this->db->query($sql)->result_array();   	 
   	 for ($i=0; $i < count($result); $i++) {    	 	
   	 	$fields = array_keys($result[$i]);
   	 	$string = '';
		foreach ($fields as $key => $value) {
		    $string .= ",$value";
		}
		$string = substr($string, 1); // remove leading ","
		$fields = '('.$string.')';
   	 	

   	 }
   	 foreach ($variable as $key => $value) {
   	 	# code...
   	 }
   	 echo "<pre>";print_r($result);die;
   }
   public function dump_test(){
   	$sql = "SHOW TABLES";
	// connect_db();
	$retval = $this->db->query($sql);
	echo "<pre>";print_r($retval);die;
	if(! $retval )
	{
	  die('Could not retrive tables: ' . mysql_error());
	}else{
		while($row = mysql_fetch_array($retval)){
			$tables[] = $row[0];
		}
	}
	$starttime = microtime(true);
	$headers = "-- MySql Data Dump\n\n";
	$headers .= "-- Database : " . db_name . "\n\n";
	$headers .= "-- Dumping started at : ". date("Y-m-d-h-i-s") .  "\n\n";

	for($t=0;$t<3;$t++){
		$outputdata .= "\n\n-- Dumping data for table : $tables[$t]\n\n";
		$sql = "SELECT * FROM $tables[$t]";
		$result = mysql_query($sql);
		while($row = mysql_fetch_assoc($result)){
			$nor = count($row);
			$datas = array();
			foreach($row as $r){
				$datas[] = $r;
			}
			$lines .= "INSERT INTO $tables[$t] VALUES (";
			for($i=0;$i<$nor;$i++){
				if($datas[$i]===NULL){
					$lines .= "NULL";
				}else if((string)$datas[$i] == "0"){
					$lines .= "0";
				}else if(filter_var($datas[$i],FILTER_VALIDATE_INT) || filter_var($datas[$i],FILTER_VALIDATE_FLOAT)){
					$lines .= $datas[$i];
				}else{
					$lines .= "'" . str_replace("\n","\\n",$datas[$i]) . "'";
				}
				if($i==$nor-1){
					$lines .= ");\n";
				}else{
					$lines .= ",";
				}
			}
			$outputdata .= $lines;
			$lines = "";
		}
	}
	$headers .= "-- Dumping finished at : ". date("Y-m-d-h-i-s") .  "\n\n";
	$endtime = microtime(true);
	$diff = $endtime - $starttime;
	$headers .= "-- Dumping data of $db_name took : ". $diff .  " Sec\n\n";
	$headers .= "-- --------------------------------------------------------";
	$datadump = $headers . $outputdata;

	$file = fopen($backupFile,"w");
	$len = fwrite($file,$datadump);
	fclose($file);
	if($len != 0){
		return true;
	}else{
		return false;
	}
   }
   public function mysql_dump1($facility_code) {
	  ini_set('memory_limit', '-1');
 	  $database = 'hcmp_rtk';
      $query = '';
 
      $tables = @mysql_list_tables($database);

      $query .= "DROP TABLE IF EXISTS ` $database.user`;\n";
         $query .= "\n" . 'CREATE TABLE `' . $database . '.user` ('."\n";
 
         $tmp = ''; 
         
 
         $results = mysql_query('SELECT * FROM ' . $database . '.user where facility=' . $facility_code);
 
         while ($row = @mysql_fetch_assoc($results)) {
 
            $query .= 'INSERT INTO `' . $database . '.user` (';
 
            $data = Array();
 
            while (list($key, $value) = @each($row)) { $databaseata['keys'][] = $key; $data['values'][] = addslashes($value); }
 
            $query .= join($data['keys'], ', ') . ')' . "\n" . 'VALUES (\'' . join($data['values'], '\', \'') . '\');' . "\n";
 
         }
 
         $query .= str_repeat("\n", 2);
 
      	// echo "<pre>";print_r($query);
    	$filename = 'test.sql';		
		!$handle = fopen($filename, 'w');
		fwrite($handle, $query);
		fclose($handle);


		header("Cache-Control: public");
		header("Content-Description: File Transfer");
		header("Content-Length: ". filesize("$filename").";");
		header("Content-Disposition: attachment; filename=$filename");
		header("Content-Type: application/octet-stream; "); 
		header("Content-Transfer-Encoding: binary");

		echo "$query";
 
      // return $query;
 
   }
 

}

 ?>