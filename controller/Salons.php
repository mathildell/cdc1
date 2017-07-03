<?php
class Salons{
  protected $db;

  public function __construct(){
    if(!$this->db){
      $this->db = new Database();
    }
  }

  public function getAll(){
    //return $this->db->getAll("salons");
    $request = "SELECT * FROM salons ";
    return $this->db->getCustomAll($request);
  }

  public function save($data){
    return $this->db->save("salons", $data);
  }

  public function remove($id){
    return $this->db->remove("salons", [':id' => intval($id) ]);
  }



  public function getAllChatMessagesTime(){
    $request = "
      SELECT chatbox.timestamp
      FROM chatbox";
    
    return $this->db->getCustomAll($request);
  }
  public function getParticip($user_id,$salon_id){
    $request = "
      SELECT id
      FROM chatbox
      WHERE chatbox.salon_id = ".$salon_id." AND chatbox.user_id = ".$user_id;
    return $this->db->getCustomAll($request);
  }

  public function getChatMessages($salon_id){
    $request = "
      SELECT users.username,
             users.picture,
             chatbox.user_id, 
             chatbox.messages,
             chatbox.timestamp
      FROM users
      JOIN chatbox
      ON chatbox.user_id = users.id
      WHERE chatbox.salon_id = ".$salon_id."
      ORDER BY chatbox.id ASC
      ";
    return $this->db->getCustomAll($request);
  }

  public function gradeUsers($data){
    $req = "UPDATE notes SET grade_user = ".$data['grade']." WHERE user_id = ".$data['user_id']." AND salon_id = ".$data['salon_id'];
    $this->db->execCustom($req);
  }
  public function update($data){
    return $this->db->edit("salons", $data);
  }

  public function getNextSalon(){
    $req1 = $this->db->getCustom("SELECT salons.* FROM salons WHERE running = 1");
    if($req1){
      return $req1;
    }else{
      return $this->db->getCustom("
        SELECT * FROM salons 
        WHERE salons.date > NOW() 
          AND work_isdeleted = 0
        ORDER BY salons.date ASC");
    }
  }
  public function getOne($data){
    return $this->db->get("salons", [':id' => $data]);
  }

  public function sendChatMessage($data){
    return $this->db->save("chatbox", $data);
  }

  public function hasVoted($id_salon, $id_user){
    $request = "
      SELECT * FROM notes
      WHERE user_id = ".$id_user." AND salon_id = ".$id_salon;
    return $this->db->getCustom($request);
  }
  public function registerGrade($data){
    return $this->db->save("notes", $data);
  }
  public function getGrades($id){
    $request = "
      SELECT users.username, 
             users.picture,
             notes.id, 
             notes.user_id, 
             notes.grade_user, 
             notes.grade 
      FROM notes 
      JOIN users 
      ON notes.user_id = users.id
      WHERE notes.salon_id = ".$id;
    return $this->db->getCustomAll($request);
  }

  public function getAllGrades(){
    $request = "SELECT grade, user_id FROM notes";
    return $this->db->getCustomAll($request);
  }

  public function getWorkOfSalon($id){
    $request = "SELECT works.* FROM works JOIN salons ON works.id = salons.work_id WHERE salons.work_isdeleted = 0 AND works.id = ".$id;
    return $this->db->getCustom($request);
  }

}