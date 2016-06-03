<?php

class PersistentObject{
    
    public static $table="undefined";

    public $id;
    public $fromDB=False;

    public function getUpdateSentence(){
        $s = array();
        $fields = $this->getFields();
        foreach ($fields as $key => $value) {
            if ($key != "id") {
                array_push($s, $key."=".$value);
            }
        }
        return "UPDATE TABLE ".static::$table." SET ".implode(",", $s)." WHERE id='".$this->id."'";
    }
    public function getFields(){
        $s = array();
        $s["id"]=$this->id;
        // return array("id" => $this->id);
        return $s;
    }
}

?>