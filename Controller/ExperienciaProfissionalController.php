<?php
if (!isset($_SESSION)) {
  session_start();
}
class ExperienciaProfissionalController
{
  public function inserir($inicio, $fim, $empresa, $descricao, $idusuario)
  {
    require_once '../Model/ExperiênciaProfissional.php';
    $expP = new ExperienciaProfissional(null, $idusuario, $inicio, $fim, $empresa, $descricao);
    $r = $expP->inserirBD();
    return $r;
  }
  public function remover($id)
  {
    require_once '../Model/ExperiênciaProfissional.php';
    $expP = new ExperienciaProfissional(null, '', '', '', '', '');
    $r = $expP->excluirBD($id);
    return $r;
  }
  public function gerarLista($idusuario)
  {
    require_once '../Model/ExperiênciaProfissional.php';
    $expP = new ExperienciaProfissional(null, $idusuario, '', '', '', '');
    return $expP->listaExperiencias($idusuario);
  }
}
