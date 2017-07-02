<?php
class Work{
  protected $db;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function getAll(){
    return $this->db->getAll("works");
  }
  public function getOrdered(){
    $request = "
    SELECT works.* 
    FROM works 
    WHERE is_deleted = 0
    ORDER BY type_id ASC";
    return $this->db->getCustomAll($request);
  }

  public function remove($id){
    $request = "UPDATE salons SET work_isdeleted = 1 WHERE work_id = ".$id;
    $this->db->execCustom($request);
    return $this->db->remove("works", [':id' => intval($id) ]);


  }
  public function update($data){
    return $this->db->edit("works", $data);
  }


  public function new($data){
    return $this->db->save("works", $data);
  }


  public function getAllWhere($data){
    //return [':type_id' => $type_id, ':category_id' => $cat_id ];
    //return "oui";

    return $this->db->getAllWhere("works", $data);
  }


  public function getOne($data){
    //return [':type_id' => $type_id, ':category_id' => $cat_id ];
    //return "oui";

    return $this->db->get("works", [':id' => $data]);
  }

  public function searchFor($query){
    $request = "SELECT works.* FROM works WHERE (description LIKE '%$query%' OR name LIKE '%$query%' OR author LIKE '%$query%' ) AND is_deleted = 0";
    return $this->db->getCustomAll($request);
  }

  public function getBookCat($id){
    $request = "SELECT categories.* FROM categories JOIN works ON works.category_id = categories.id WHERE works.id = ".$id;
    return $this->db->getCustom($request);
  }
  public function getBookType($id){
    $request = "SELECT type.* FROM type JOIN works ON works.type_id = type.id WHERE works.id = ".$id;
    return $this->db->getCustom($request);
  }

}