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
    $query = 'SELECT t.id as id, s.id as id_status, s.status, tarefa 
    FROM tb_tarefas t
    LEFT JOIN tb_status s
    ON t.id_status = s.id';
    $stmt = $this->conexao->prepare($query);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function recuperarTarefasPendentes(){
    $query = 'SELECT t.id as id, s.id as id_status, s.status, tarefa 
    FROM tb_tarefas t
    LEFT JOIN tb_status s
    ON t.id_status = s.id
    WHERE t.id_status = ?';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(1, $this->tarefa->__get('id_status'), PDO::PARAM_INT);
    $stmt->execute();
    return $stmt->fetchAll(PDO::FETCH_ASSOC);
  }

  public function atualizar(){
    $query = 'UPDATE tb_tarefas SET tarefa = ? WHERE id = ?';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(1, $this->tarefa->__get('tarefa'), PDO::PARAM_STR);
    $stmt->bindValue(2, $this->tarefa->__get('id'), PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function remover(){
    $query = 'DELETE from tb_tarefas WHERE id = ?';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(1, $this->tarefa->__get('id'), PDO::PARAM_INT);
    return $stmt->execute();
  }

  public function finalizarTarefa(){
    $query = 'UPDATE tb_tarefas SET id_status = ? WHERE id = ?';
    $stmt = $this->conexao->prepare($query);
    $stmt->bindValue(1, $this->tarefa->__get('id_status'), PDO::PARAM_INT);
    $stmt->bindValue(2, $this->tarefa->__get('id'), PDO::PARAM_INT);
    return $stmt->execute();
  }
}