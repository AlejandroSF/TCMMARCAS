<?php
include_once 'SQLParser.php';
include_once 'Settings.php';

class PersistentObject{

    public $id;//La Primary Key, debe ser numérica y auto-incrementada (o autogenerada)
    public $fromDB=False;//Indica si el objeto se ha recuperado de la base de datos o si, por el contario (caso por defecto), se ha creado fuera
    public static $parser;

    function __construct(){
        $this->fromDB = False;
    }

    public static function getParser(){
        if (!isset(static::$parser)) {
            static::$parser = (new SQLParser(get_called_class()));
        }
        return static::$parser;
    }
    public static function getTableName(){
        return "`".DBName."`.`".get_called_class()."`";
    }

    public function getFields($excludeAuxiliaryFields = True){//Devolvemos los campos como array asociativo (excepto la clave primaria y el flag de persistencia)
        $array = (array)$this;
        if ($excludeAuxiliaryFields) {
            unset($array['id']);
            unset($array['fromDB']);
        }
        return $array;
    }
    public function __toString(){
        return json_encode($this->getFields(False));
    }
    public function getUpdateSentence(){
        $s = array();
        $fieldStrings = static::getParser()->objectToStringArray($this->getFields());
        foreach ($fieldStrings as $k => $v) {
            array_push($s, $k."=".$v);
        }
        return "UPDATE TABLE ".static::getTableName()." SET ".implode(", ", $s)." WHERE `id`='".$this->id."';";
    }
    public function getInsertSentence(){
        return "INSERT INTO ".static::getTableName()." (`id`, ".implode(", ",array_keys(static::getParser()->objectToStringArray($this->getFields()))).") VALUES (NULL, ".implode(",",array_values(static::getParser()->objectToStringArray($this->getFields()))).");";
    }

    public function save(){
        $query = ($this->fromDB)?($this->getUpdateSentence()):($this->getInsertSentence());//Si el objeto procedía de la BD, la sentencia que queremos ejecutar es un UPDATE, en caso contrario, INSERT
        $db =DBConnect();
        $cursor = mysqli_query($db, $query);
        if ($cursor === False) {
            echo "Error en el guardado del objeto";//Si hay un error, pues se dice y no pasa nada
        }else{
            if ($this->fromDB != True) {
                $this->id = mysqli_insert_id($db);
                $this->fromDB = True;//Ahora que el objeto está en la BD, actualizamos el flag, de manera que la próxima vez que guardemos, sea con un UPDATE
            }
        }
    }
    public function delete(){
        $cursor = getResultFromQuery("DELETE FROM ".static::getTableName()." WHERE `id` = '".$this->id."';");
        if ($cursor === False) {
            echo "Error en el borrado del objeto";//Si hay un error, pues se dice y no pasa nada
        }else{
            $this->fromDB = False;//Ahora el objeto existe en tiempo de ejecución, pero no en la BD
            unset($this->id);
        }
    }

    public static function getByConditions($conditions){//función genérica para recuperar objetos verificando unas condiciones
        $s = array();
        foreach (static::getParser()->objectToStringArray($conditions) as $k => $v) {
            array_push($s, $k."=".$v);//Agrupamos las condiciones en cadenas como "nombre_columna = valor_columna"
        }
        $conditionsString = implode(" AND ", $s);//Los unimos con "AND", para tener algo como "Condición1 AND Condición2 AND Condición3…"
        $cursor = getResultFromQuery("SELECT * FROM ".static::getTableName()." WHERE ".$conditionsString.";");//Construimos la consulta
        $objectArray = array();//Creamos el array que contendrá los objetos recuperados
        for ($i=0; $i < mysqli_num_rows($cursor); $i++) {
            $row = mysqli_fetch_assoc($cursor);
            $object = new static();//Instanciamos la clase actual (en la que se ejecuta el código, puede ser una clase hija)
            foreach (static::getParser()->stringToObjectArray($row) as $attribute => $value) {
                if (property_exists($object, $attribute)) {//Si la instancia tiene una campo llamado como el atributo recuperado de la BD (y así debería ser), se lo metemos
                    $object -> $attribute = $value;
                }
            }
            $object->fromDB = True;//El objeto viene de la BD, y lo marcamos como tal
            array_push($objectArray, $object);//Por último, lo metemos en el array a devolver
        }
        return $objectArray;
    }

    public static function getById($id){//Ejemplo de recuperación de objeto a partir de su clave primaria
        $condition = array('id' => $id);//Así se definen las condiciones <------ IMPORTANTE!!!
        $result = static::getByConditions($condition);//Llamamos al método anterior
        return (count($result)>0)? $result[0]:null;//Si devuelve algún objeto, lo sacamos del array y lo devolvemos, en caso contrario devolvemos null
    }
}
?>