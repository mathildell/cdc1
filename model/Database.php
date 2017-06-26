<?php

require( $_SERVER['DOCUMENT_ROOT'] . '/config/db_config.php');

class Database{
  protected $db;
  public function __construct(){
    if(!$this->db){
      $this->db = new PDO('mysql:host='.DB_CONFIG::DB_HOST.';dbname='.DB_CONFIG::DB_NAME.'', DB_CONFIG::DB_UN, DB_CONFIG::DB_PWD);
      $this->db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    };
  }
  
  public function getPreparedStatement($action, $table, $data){
    if($action === "save"){
      $query = "INSERT INTO "; 
      $query .= $table . " ("; 
      $i = 0; $count = count($data) - 1;
      for($u = 0; $u < 2; $u++){
        foreach ($data as $columnName => $value) {
          if($i !== 0 && $i !== $count+1){
            $query .= ", ";
          }
          if($u === 1){
            if($i === $count+1){
              $query .= ") VALUES (";
            }
            $query .= $columnName;
            if($i === ($count * 2)+1 ){
              $query .= ")";
            }
          }else{
            $query .= ltrim($columnName, ':');
          }
          $i++;
        }
      }
    }

    else if($action === "get"){
      $query = "SELECT * FROM "; 
      $query .= $table . " WHERE "; 
      $i = 0;
      foreach ($data as $columnName => $value) {
        if($i !== 0){
          $query .= " AND ";
        }
        
        $query .= ltrim($columnName, ':')." = ".$columnName;
      

        $i++;
      }


    }

    else if($action === "edit"){
      /*UPDATE table_name
      SET column1 = value1, column2 = value2, ...
      WHERE condition;*/
      $query = "UPDATE "; 
      $query .= $table . " SET "; 
      $i = 0;
      foreach ($data as $columnName => $value) {
        if($i !== 0 && $i !== count($data) - 1 ){
          $query .= ", ";
        }
        if($i !== count($data) - 1){
          $query .= ltrim($columnName, ':')." = ".$columnName;
        }
        $i++;
      }
      end($data);
      $query .= " WHERE id = ".key($data);
    }
    else if($action === "remove"){

    }


    //return $query;
    return $this->db->prepare($query);
  }
//data
  public function save($table, $data){
    $this->sql = SELF::getPreparedStatement("save", $table, $data);
    //return $this->sql;
    return $this->sql->execute($data);
  }

  public function get($table, $data){
    $this->sql = SELF::getPreparedStatement("get", $table, $data);
    $this->sql->execute($data);
    return $this->sql->fetch(PDO::FETCH_ASSOC);
  }

  public function remove($table, $data){
    $this->sql = SELF::getPreparedStatement("remove", $table, $data);
    return $this->sql->execute($data);
  }

  public function getAllWhere($table, $data){
    $this->sql = SELF::getPreparedStatement("get", $table, $data);
    $this->sql->execute($data);
    return $this->sql->fetchAll(PDO::FETCH_ASSOC);
  }

  public function getAll($table){
    $this->sql = $this->db->prepare("SELECT * FROM ".$table);
    $this->sql->execute();
    return $this->sql->fetchAll(PDO::FETCH_ASSOC);
  }
  
  public function lastInsertId(){
    return $this->db->lastInsertId();
  }

  public function edit($table, $data){
    $this->sql = SELF::getPreparedStatement("edit", $table, $data);
    //->execute($data)
    return $this->sql->execute($data);
  }

  public function getCustomAll($req){
    $this->sql = $this->db->prepare($req);
    $this->sql->execute();
    return $this->sql->fetchAll(PDO::FETCH_ASSOC);
  }
  public function getCustom($req){
    $this->sql = $this->db->prepare($req);
    $this->sql->execute();
    return $this->sql->fetch(PDO::FETCH_ASSOC);
  }
  
}