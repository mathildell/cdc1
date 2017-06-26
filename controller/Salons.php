<?php
class Salons{
  protected $db;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function getAll(){
    return $this->db->getAll("salons");
  }

  public function getNextSalon(){
    $request = "SELECT salons.* FROM salons ORDER BY date DESC LIMIT 1";
    return $this->db->getCustom($request);
  }

  public function getOne($data){
    return $this->db->get("salons", [':id' => $data]);
  }

  public function getWorkOfSalon($id){
    $request = "SELECT works.* FROM works JOIN salons ON works.id = salons.work_id WHERE works.id = ".$id;
    return $this->db->getCustom($request);
  }

}