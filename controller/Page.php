<?php
class Page{
  protected $db;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function getAll(){
    return $this->db->getAll("custom_items");
  }
  public function getOne($id){
    return $this->db->get("custom_items", [':id' => $id]);
  }
  public function getPages(){
    return $this->db->getAllWhere("custom_items", [':is_footer_link' => 1, ':is_draft' => 0]);
  }
  public function edit($data){
    return $this->db->edit("custom_items", $data);
  }
  public function save($data){
    return $this->db->save("custom_items", $data);
  }
  public function delete($data){
    return $this->db->remove("custom_items", [':id' => $data]);
  }
}