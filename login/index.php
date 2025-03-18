<?php
session_start();
include "./../lib/gerarHeader.php";
?>


<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="icon" type="image.ico" href="fav.ico" />

  <title>SICHS VRSD - Login</title>

  <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

  <link href="/css/general.css" rel="stylesheet">
  <link href="/css/signin.css" rel="stylesheet">
</head>

<body>
  <?php
  gerarHeader();
  ?>

  <div class="container">

    <form class="form-signin" method="POST" action="valida.php">
      <label for="inputLogin" class="sr-only">Login</label>
      <input type="text" name="login" id="inputLogin" class="form-control" placeholder="Login" required autofocus>

      <label for="inputPassword" class="sr-only">Senha</label>
      <input type="password" name="senha" id="inputPassword" class="form-control" placeholder="Senha" required>
      <button class="btn btn-lg btn-primary btn-block" type="submit">Acessar</button>
    </form>
    <p class="text-center text-danger">
      <?php if (isset($_SESSION['loginErro'])) {
        echo $_SESSION['loginErro'];
        unset($_SESSION['loginErro']);
      } ?>
    </p>
    <p class="text-center text-success">
      <?php
      if (isset($_SESSION['logindeslogado'])) {
        echo $_SESSION['logindeslogado'];
        unset($_SESSION['logindeslogado']);
      }
      ?>
    </p>
  </div>

  <script src="/js/jquery-3.2.1.slim.min.js"></script>
  <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
</body>

</html>