<?php
include_once 'PersistentObject.php';

error_reporting(0);
class SQLParser{

	public $clientClass;
	public $fieldType = array();

	function __construct($clientClass){//El constructor recibe una referencia a la clase de la que se ocupa de "parsear"
		$this->clientClass = $clientClass;
		$query = "DESCRIBE ".$clientClass.";";
		$db = DBConnect();
		$fields = mysqli_query($db, $query);
		foreach ($fields as $fieldName => $fieldInfo) {
			$this->fieldType[$fieldInfo['Field']] = explode("(",$fieldInfo['Type'])[0];//En el array FieldType, almacenamos el tipo de variable que espera la base de datos para cada campo
		}
	}

	public function objectToStringArray($objects){
		$strings = array();
		foreach ($objects as $key => $value) {
			switch ($this->fieldType[$key]) {//En función del tipo de valor esperado, aplicamos una conversión u otra (en este momento son todas la misma, pero eso probablemente cambie)
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
?>