<?php
include_once 'PersistentObject.php';
include_once 'GameReservation.php';

class SQLParser{

	public $clientClass;
	public $fieldType = array();

	function __construct($clientClass){
		$this->clientClass = $clientClass;
		$query = "DESCRIBE ".$clientClass.";";
		$db = $clientClass::DBConnect();
		$fields = mysqli_query($db, $query);
		foreach ($fields as $fieldName => $fieldInfo) {
			$this->fieldType[$fieldName] = explode("(",$fieldInfo['Type'])[0];
			//echo $this->fieldType[$fieldName]."<br>";
			//echo "<br>".$fieldName."<br><br>";
			//foreach ($fieldInfo as $fieldAttribute => $attributeValue) {
				//echo $fieldAttribute.": ".$attributeValue."<br>";
			//}
		}
	}

	public function ObjectToStringArray($objects){
		$strings = array();
		foreach ($objects as $key => $value) {
			switch ($this->fieldType[$key]) {
				case 'int':
					array_push($strings, $value);
					break;
				case 'varchar':
					array_push($strings, "'".$value."'");
					break;
				default:
					array_push($strings, "'".$value."'");
					break;
			}
		}
	}
}
new SQLParser("GameReservation");
?>