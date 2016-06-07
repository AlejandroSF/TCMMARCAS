<?php
include_once 'PersistentObject.php';
include_once 'GameReservation.php';
include_once 'Settings.php';

error_reporting(0);
class SQLParser{

	public $clientClass;
	public $fieldType = array();

	function __construct($clientClass){
		$this->clientClass = $clientClass;
		$query = "DESCRIBE ".$clientClass.";";
		$db = DBConnect();
		$fields = mysqli_query($db, $query);
		foreach ($fields as $fieldName => $fieldInfo) {
			$this->fieldType[$fieldInfo['Field']] = explode("(",$fieldInfo['Type'])[0];
		}
	}

	public function ObjectToStringArray($objects){
		$strings = array();
		foreach ($objects as $key => $value) {
			switch ($this->fieldType[$key]) {
				case 'int':
					$strings[$key]=strval($value);
					break;
				case 'varchar':
					$strings[$key]="'".$value."'";
					break;
				default:
					$strings[$key]="'".$value."'";
					break;
			}
		}
		return $strings;
	}
}
// echo "<br><br><br>";
// $parser = new SQLParser("GameReservation");
// //var_dump($parser->fieldType);
// foreach ($parser->fieldType as $key => $value) {
// 	echo $key.": ".$value."<br>";
// }
?>