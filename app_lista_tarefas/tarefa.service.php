<?php 

class TarefaService {
  private $conexao, $tarefa;
  public function __construct(Conexao $conexao, Tarefa $tarefa) {
    $this->conexao = $conexao->conectar();
    $this->tarefa = $tarefa;
  }
  public function inserir(){
    $query = "INSERT INTO tb_tarefas(tarefa) VALUES(:tarefa)";
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(":tarefa", $this->tarefa->__get('tarefa'), PDO::PARAM_STR);
    $stmt->execute();
  }

  public function recuperar(){
    $query = 'SELECT t.id as id, s.status, tarefa 
    FROM tb_tarefas t
    LEFT JOIN tb_status s
    ON t.id_status = s.id';
    $stmt = $this->conexao->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function atualizar(){}

  public function remover(){}
}