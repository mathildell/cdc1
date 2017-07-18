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
  
  public function getAllAdminEmails(){
    $request = "
      SELECT * FROM admin_messages ORDER BY admin_messages.timestamp DESC";
    return $this->db->getCustomAll($request);
  }
  public function getAdminEmail($id){
    $request = "
      SELECT * FROM admin_messages 
      WHERE id = ".$id;
    return $this->db->getCustom($request);
  }

  public function getUnread($table, $id){
      $request = "SELECT id FROM ".$table." WHERE unread = 1";
    if($table === "private_messages"){
      $request .= " AND receiver_id = ".$id;
    }
    return $this->db->getCustomAll($request);
  }

  public function messageUnread($table, $id){
    $request = "SELECT unread FROM ".$table." WHERE id = ".$id;
    return $this->db->getCustom($request);
  }

  public function sendReadNotif($table, $id){
    return $this->db->edit($table, [':unread' => 0, ':id' => $id]);
  }

  public function registerEmail($pwd, $email){
    return $this->db->save("users", [ ":email" => $email, ":username" =>explode("@", $email)[0], ":password" =>  $pwd ]);
  }

  public function newAdminUser($data){
    return $this->db->save("users", $data);
  }
  public function saveUser($data){
    return $this->db->edit("users", $data);
    
  }

  public function sendMessage($data){
    return $this->db->save("private_messages", $data);
  }


  public function sendMessageToAdmin($data){
    return $this->db->save("admin_messages", $data);
  }

  

  public function newFriend($data){
    return $this->db->save("friends", $data);
  }
  public function deleteFriend($data){
    return $this->db->remove("friends", $data);
  }

  public function areWeFriends($id_1, $id_2){
    $request = "SELECT * FROM friends WHERE user_1_id = ".$id_1." AND user_2_id = ".$id_2;
    return $this->db->getCustom($request);
  }
  public function getFriends($id){
    $request = "SELECT users.*, friends.timestamp FROM users
      JOIN friends ON friends.user_2_id = users.id
      WHERE user_1_id = ".$id." ORDER BY friends.id DESC";
    return $this->db->getCustomAll($request);
  }



  public function getUserMessages($id){
    $request = "
      SELECT * FROM private_messages 
      WHERE receiver_id = ".$id." ORDER BY unread DESC";

    return $this->db->getCustomAll($request);
  }

  public function getUserSentMessages($id){
   $request = "
      SELECT * FROM private_messages
      WHERE sender_id = ".$id." ORDER BY id DESC";
     /*
    $request = "
    SELECT private_messages.*, admin_messages.*
    FROM admin_messages
    JOIN private_messages
    ON admin_messages.sender_id = private_messages.sender_id
    WHERE admin_messages.sender_id = ".$id;


    $request = "SELECT private_messages.*, admin_messages.*
      FROM private_messages, admin_messages
      WHERE admin_messages.sender_id = private_messages.sender_id";

  */
    return $this->db->getCustomAll($request);
  }

  public function getUserMessage($id){
    $request = "
      SELECT * FROM private_messages 
      WHERE id = ".$id;

    return $this->db->getCustom($request);
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
    return $this->db->remove("users", [':id' => intval($id) ]);
  }

  public function addExchange($data){
    return $this->db->save("exchanges", $data);
  }

  public function updateExchange($data){
    return $this->db->edit("exchanges", $data);
  }

  public function deleteExchange($data){
    return $this->db->remove("exchanges", $data);
  }

  public function getExStatus($id){
    switch($id){
      case 0: return "À prêter"; break;
      case 1: return "Prêté"; break;
      case 2: return "Je le veux"; break;
      default: return "undefined"; break;
    }
  }

  public function getExchangesFromBook($id){
    /*
      J'ai le work_id
      Je veux l'user
      Qui dans la table exchange
      A ce work_id

    */
    $request = "
      SELECT users.*, exchanges.status
      FROM users

      JOIN exchanges 
      ON users.id = exchanges.user_id

      JOIN works 
      ON works.id = exchanges.work_id

      WHERE exchanges.work_id = ".$id."
      ORDER BY exchanges.status DESC ";

    return $this->db->getCustomAll($request);
  }


  public function doIHaveThisBook($id, $book){
    $request = "SELECT status FROM exchanges WHERE user_id = ".$id." AND work_id = ".$book;
    return $this->db->getCustom($request);
  }

  public function getAllExchanges(){
    $request = "SELECT * FROM exchanges ORDER BY user_id ASC";
    return $this->db->getCustomAll($request);

  }

  public function getExchanges($id){
    $request = "
      SELECT works.*, exchanges.ex_id, exchanges.status FROM works 
      JOIN exchanges 
      ON works.id = exchanges.work_id 
      WHERE exchanges.user_id = ".$id."
      ORDER BY exchanges.status DESC, exchanges.ex_id DESC";

    return $this->db->getCustomAll($request);
  }

}