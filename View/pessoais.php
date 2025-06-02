<!DOCTYPE html>
<html lang="pt-BR">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial- scale=1.0">
  <meta http-
    equiv="X-UA-Compatible" content="ie=edge">
  <link rel="stylesheet" href="style.css">
  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-
awesome.min.css">
  <title>Enlatados Juarez</title>
  <style>
    /* Definimos que a sidebar terá uma largura de 120px e cor a cord de fundo #222 */
    .w3-sidebar {
      width: 120px;
    }

    /*Define Fonte para todas as tags listadas abaixo*/
    body,
    h1,
    h2,
    h3,
    h4,
    h5,
    h6 {
      font-family: "Montserrat", sans-serif
    }
  </style>
</head>

<body class="w3-light-grey">
  <?php
  include_once '../Model/Usuario.php';
  if (!isset($_SESSION)) {
    session_start();
  }
  ?>

  <nav class="w3-sidebar w3-bar-block w3-center w3-blue ">
    <a href="./principal.php" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-grey w3-hover-text-cyan w3-text-
light-grey">
      <i class="fa fa-home w3-xxlarge"></i>
      <p>HOME</p>
    </a>
    <a href="./pessoais.php" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-greyw3-hover-text-
cyan w3-text-light-grey">
      <i class="fa fa-address-book-o w3-xxlarge"></i>
      <p>Dados Pessoais</p>
    </a>
    <a href="./formacao.php" class="w3-bar-item w3-button w3-block n w3-cell w3-hover-light-greyw3-hover-text-
cyan w3-text-light-grey">
      <i class="fa fa-mortar-board w3-xxlarge"></i>
      <p>Formação</p>
    </a>
  </nav>
  <div class="w3-padding-128 w3-content w3-text-grey" id="dPessoais">
    <h2 class="w3-text-cyan">Dados Pessoais</h2>
    <form action="/Controller/Navegacao.php" method="post" class=" w3-row w3-light-grey w3-text-blue w3-margin" style="width:70%;">
      <input class="w3-input w3-border w3-round-large" name="txtID" type="hidden" value="<?php echo unserialize($_SESSION['Usuario'])->getID(); ?>">
      <div class="w3-row w3-section">
        <div class="w3-col" style="width:11%;">
          <i class="w3-xxlarge fa fa-user"></i>
        </div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="txtNome" type="text" placeholder="Nome Completo" value="<?php echo unserialize($_SESSION['Usuario'])->getNome(); ?>">
        </div>
        <div class="w3-col" style="width:11%;">
          <i class="w3-xxlarge fa fa-calendar"></i>
        </div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="txtData" type="date" placeholder="Data de Nascimento" value="<?php echo unserialize($_SESSION['Usuario'])->getDataNascimento(); ?>">
        </div>
        <div class="w3-col" style="width:11%;">
          <i class="w3-xxlarge fa fa-user"></i>
        </div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="txtCPF" type="text" placeholder="CPF" value="<?php echo unserialize($_SESSION['Usuario'])->getCPF(); ?>">
        </div>
        <div class="w3-col" style="width:11%;">
          <i class="w3-xxlarge fa fa-envelope"></i>
        </div>
        <div class="w3-rest">
          <input class="w3-input w3-border w3-round-large" name="txtEmail" type="text" placeholder="Email" value="<?php echo unserialize($_SESSION['Usuario'])->getEmail(); ?>">
        </div>
      </div>
      <div>
        <button name="btnAtualizar" type="submit" class="w3-button w3-block w3-blue w3-cell w3-round-large" style="width: 100%;">Atualizar</button>
      </div>
    </form>
  </div>
</body>



</html>