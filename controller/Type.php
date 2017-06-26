<?php
class Type{
  protected $db;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function getAll(){
    return $this->db->getAll("type");
  }
  public function getOne($id){
    return $this->db->get("type", [':id' => $id]);
  }

  public function getIdByName($name){
    return $this->db->get("type", [':name' => $name])["id"];
  }

}