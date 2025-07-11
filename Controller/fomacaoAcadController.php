<?php
if (!isset($_SESSION)) {
  session_start();
}
class FormacaoAcadController
{
  public function inserir($inicio, $fim, $descricao, $idusuario)
  {
    require_once '../Model/FormacaoAcad.php';
    $formacao = new FormacaoAcad(null, $idusuario, $inicio, $fim, $descricao);
    $r = $formacao->inserirBD();
    return $r;
  }
  public function remover($id)
  {
    require_once '../Model/FormacaoAcad.php';
    $formacao = new FormacaoAcad(null, 0, '', '', '');
    $r = $formacao->excluirBD($id);
    return $r;
  }
  public function gerarLista($idusuario)
  {
    require_once '../Model/FormacaoAcad.php';
    $formacao = new FormacaoAcad(null, $idusuario, '', '', '');
    return $formacao->listaFormacoes($idusuario);
  }
}
