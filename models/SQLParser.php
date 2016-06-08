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

	public function objectToStringArray($objects){
		$strings = array();
		foreach ($objects as $key => $value) {
			switch ($this->fieldType[$key]) {
				case 'int':
					$strings["`".$key."`"]="'".$value."'";
					break;
				case 'varchar':
					$strings["`".$key."`"]="'".$value."'";
					break;
				default:
					$strings["`".$key."`"]="'".$value."'";
					break;
			}
		}
		return $strings;
	}
	public function stringToObjectArray($strings){
		$objects = array();
		foreach ($strings as $key => $value) {
			switch ($this->fieldType[$key]) {
				case 'int':
					$objects[$key]=intval($value);
					break;
				case 'varchar':
					$objects[$key]=$value;
					break;
				default:
					$objects[$key]=$value;
					break;
			}
		}
		return $objects;
	}
}
// echo "<br><br><br>";
// $parser = new SQLParser("GameReservation");
// //var_dump($parser->fieldType);
// foreach ($parser->fieldType as $key => $value) {
// 	echo $key.": ".$value."<br>";
// }
?>