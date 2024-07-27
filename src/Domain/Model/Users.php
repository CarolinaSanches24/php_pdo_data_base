<?php
class Users {
    public $id;
    public $name;

    public function __construct($id, $name) {
        $this->id = $id;
        $this->name= $name;
     
    }
  
}

$user = $stmt->fetchObject('Users');

