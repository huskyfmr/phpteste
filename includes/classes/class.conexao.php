<?php 

class Conexao
{
  // Propriedades
  public $servername = "localhost";
  public $username = "app_tcc";
  public $password = "1234abcd";
  public $dbname = "teste";
  public $conn;

  // Método
  private function conectar() {
    // $username = "Thiago"
    $this->conn = new mysqli($this->servername, $this->username, $this->password, $this->dbname);
    if($this->conn->connect_error) {
      return "Falhou";
    } else {
      return "Funcionou!";
    }
  }

  public function query($sql){
    $this->conectar();
    $result = $this->conn->query($sql);
    return $result;
  } 
}

?>