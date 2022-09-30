<?php
//nclude 'includes/classes/class.conexao.php';

class Professor {
    // Propriedades
    public $nome;
    public $id;
    public $especilidade;
    public $lattes;
    private $conn;


    // Métodos
    function __construct($id) {
        $this->conn = new Conexao();
        $result = $this->conn->query("select * from professores where id_professores = $id");
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $this->id = $row["id_professores"];
                $this->nome = $row["nome"];
                $this-> especialidade = $row["especialidade"];
                $this->lattes = $row["id_lattes"];
            }
        } else {
            echo "Não encontrei o professor com o id $id.";
        }
    }

    public static function pesquisarProfessores($criterio, $valor){
        $conn = new Conexao();
        $result = $conn->query("select * from professores where $criterio like '%$valor%'");
        $conjuntoProfessores = new ArrayObject();
        if($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                $conjuntoProfessores->append(new Professor($row['id_professores']));
            }
            return $conjuntoProfessores;
        } else {
            echo "Não encontrei o professor com o critério $criterio e valor $valor.";
        }
    }
}
?>
