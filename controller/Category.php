<?php
class Category{
  protected $db;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function getAll(){
    return $this->db->getAll("categories");
  }
  public function getOne($id){
    return $this->db->get("categories", [':id' => $id]);
  }
  public function edit($data){
    return $this->db->edit("categories", $data);
  }
  public function save($data){
    return $this->db->save("categories", $data);
  }

  public function getIdByName($name){
    return $this->db->get("categories", [':name' => $name])["id"];
  }

}