<?php

class PersistentObject{

    public $id;
    public $fromDB=False;

    public function getFields(){
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
        return "UPDATE TABLE ".get_called_class()." SET ".implode(",", $s)." WHERE id='".$this->id."'";
    }

}
?>