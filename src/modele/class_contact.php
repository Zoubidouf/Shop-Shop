<?php
class Contact{
    private $db;
    private $insert;
    private $select;

    public function __construct($db){
        $this->db = $db;
        $this->insert = $this->db->prepare("insert into Contact (Nom, Email, Message) values (:Nom, :Email, :Message)");
        $this->select = $this->db->prepare("select id, Nom, Email, Message from Contact");
    }

    public function insert($Nom, $Email, $Message){
        $r = true;
        $this->insert->execute(array(':Nom'=>$Nom, ':Email'=>$Email, ':Message'=>$Message));
        if ($this->insert->errorCode()!=0){
            print_r($this->insert->errorInfo());
            $r=false;
        }
            return $r;
    }

    public function select(){
        $this->select->execute();
        if ($this->select->errorCode()!=0){
            print_r($this->select->errorInfo());
        }
        return $this->select->fetchAll();
    }
}
?>