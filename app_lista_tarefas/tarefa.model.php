<?php

class Tarefa {
  private $id, $id_status, $tarefa, $data_cadastro;

  public function __get($attr){
    return $this->$attr;
  }

  public function __set($attr, $value){
    $this->$attr = $value;
  }
}