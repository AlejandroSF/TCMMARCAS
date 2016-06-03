<?php

class PersistentObject{

    public $id;//La Primary Key, debe ser numérica y auto-incrementada (o autogenerada)
    public $fromDB=False;//Indica si el objeto se ha recuperado de la base de datos (funcionalidad aún no disponible)
                            // o si, por el contario (caso por defecto), se ha creado fuera

    public function getFields(){//Devolvemos los campos como array asociativo (excepto la clave primaria y el flag de persistencia)
        $array = (array)$this;
        unset($array['id']);
        unset($array['fromDB']);
        return $array;
    }
    public function getUpdateSentence(){
        $s = array();
        foreach ($this->getFields() as $k => $v) {
            array_push($s, $k."=".$v);
        }
        return "UPDATE TABLE ".get_called_class()." SET ".implode(",", $s)." WHERE id='".$this->id."';";
    }
    public function getInsertSentence(){
        return "INSERT INTO ".get_called_class()." VALUES (".implode(",",array_keys($this->getFields())).") VALUES ".implode(",",array_values($this->getFields())).";";
    }
    public function DBConnect() {
    $con = mysqli_connect("localhost","API","hola","TCMMARCAS");
    if (mysqli_connect_errno()) {
        printf("Error de conexión: %s\n", mysqli_connect_error());
        exit();
    }else{
        mysqli_set_charset($con, "utf8");//Importante, que luego las "ñ"s (y demás) dan problemas
        return $con;
    }

    public function save(){
        $sql = ($this->fromDB)?($this->getUpdateSentence()):($this->getInsertSentence());//Si el objeto procedía de la BD, la sentencia que queremos ejecutar es un UPDATE, en caso contrario, INSERT
        $cursor = mysqli_query($this->DBConnect(), $sql);
        if ($cursor === False) {
            echo "Error en el guardado del objeto";//Si hay un error, pues se dice y no pasa nada
        }else{
            $this->fromDB = True;//Ahora que el objeto está en la BD, actualizamos el flag, de manera que la próxima vez que guardemos, sea con un UPDATE
        }
    }
}
}
?>