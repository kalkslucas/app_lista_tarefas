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
} 
else if($acao == 'recuperar'){
  $tarefa = new tarefa();
  $conexao = new Conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  $tarefas = $tarefaService->recuperar();
} 
else if($acao == 'atualizar'){
  $tarefa = new tarefa();
  $tarefa->__set('id',$_POST['id'])->__set('tarefa',$_POST['tarefa']);
  $conexao = new Conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  if($tarefaService->atualizar()){
    header('Location: todas_tarefas.php');
  }
}
else if($acao == 'remover'){
  $tarefa = new tarefa();
  $tarefa->__set('id',$_GET['id']);
  $conexao = new Conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  if($tarefaService->remover()){
    header('Location: todas_tarefas.php');
  }
}
else if($acao == 'finalizarTarefa'){
  $tarefa = new tarefa();
  $tarefa->__set('id',$_GET['id'])->__set('id_status', 2);
  $conexao = new Conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  if($tarefaService->finalizarTarefa()){
    header('Location: todas_tarefas.php');
  }
}
else if($acao == 'recuperarTarefasPendentes'){
  $tarefa = new tarefa();
  $tarefa->__set('id_status', 1);
  $conexao = new Conexao();

  $tarefaService = new tarefaService($conexao, $tarefa);
  $tarefas = $tarefaService->recuperarTarefasPendentes();
}
