<?php 

class Conexao {
  private $dsn = "mysql:host=localhost;dbname=pdo;charset=utf8mb4", $username = "root", $password = "";
  
  public function conectar() {
    try {
      $connection = new PDO($this->dsn, $this->username, $this->password);
      $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

      return $connection;
    } catch (PDOException $e) {
      echo $e->getMessage();
    }
  }
}



