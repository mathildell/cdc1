<?php
class User{
  protected $db;
  public $id;
  public $name;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function registerEmail($email){
    return $this->db->save("users", [ ":email" => $email ]);
  }

  public function saveUser($username, $email, $pwd, $description, $isAdmin, $id){
    if($isAdmin !== "no"){
      return $this->db->edit("users", 
        [ 
          ":email" => $email, 
          ':username' => $username, 
          ":password" => $pwd, 
          ':description' => $description, 
          ":isAdmin" => $isAdmin, 
          ':id' => $id 
        ]
      );
    }else{
      return $this->db->edit("users", 
        [ 
          ":email" => $email, 
          ':username' => $username, 
          ":password" => $pwd, 
          ':description' => $description, 
          ':id' => $id 
        ]
      );
    }
    
  }

  public function login($email, $pwd){
    return $this->db->get("users", [ ":email" => $email, ":password"  => $pwd ]);
  }

  public function get($id){
    return $this->db->get("users", [ ":id" => $id ]);
  }

  public function getAll(){
    return $this->db->getAll("users");
  }

  public function removeUser($id){
    return $this->db->remove("users", [':id', $id]);
  }

  public function getExchanges($id){
    $request = "
      SELECT works.* FROM works 
      JOIN exchanges 
      ON works.id = exchanges.work_id 
      WHERE exchanges.user_id = ".$id;

    return $this->db->getCustomAll($request);
  }

}