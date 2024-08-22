<?php

require 'tarefa.model.php';
require 'tarefa.service.php';
require 'conexao.php';
//Busca do valor parâmetro passado pelo formulário de tarefa_controller.php
$acao = isset($_GET['acao']) ? $_GET['acao'] : $acao;



if($acao == 'inserir'){
  $tarefa = new tarefa();
  $tarefa->__set('tarefa',$_POST['tarefa']);

  $conexao = new conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  $tarefaService->inserir();

  //requisição inicial realizada no diretório publico
  header('Location: nova_tarefa.php?inclusao=1');
} else if($acao == 'recuperar'){
  $tarefa = new tarefa();
  $conexao = new Conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  $tarefas = $tarefaService->recuperar();
}

