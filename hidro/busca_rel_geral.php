<?php
session_start();
include_once("./../lib/conexao.php");
include_once("./../lib/gerarHeader.php");
include_once("./../lib/hidrometro.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta http-equiv="content-type" content="text/html;charset=ISO-8859-1" />
    <title>Relatório Geral - Hidrômetros</title>

    <link rel="icon" type="image.ico" href="fav.ico" />
    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/general.css">

    <style>
        .footer {
            position: absolute;
            bottom: 0;
        }
    </style>
</head>

<body>
    <?php
    gerarHeaderComMenu();
    ?>

    <br>
    <h2 class="title"> Relatório Geral de Hidrômetros</h2>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    $hoje = date('Y-m-d'); // Data atual
    ?>
    <br>
    <form class="container col-md-6" method="post" action="rel_geral.php">
        <label class="form-label" for="hidrometro">Hidrômetro</label>
        <?php
        gerarSelectHidrometro();
        ?>

        <label class="form-label" for="datainicio">Data de Início</label>
        <input class="form-control" type="date" name="datainicio" placeholder="Selecione a Data Inicial"
            value="<?php echo $hoje; ?>" required>
        <br>

        <label class="form-label" for="datafinal">Data Final</label>
        <input class="form-control" type="date" name="datafinal" placeholder="Selecione a Data Final"
            value="<?php echo $hoje; ?>" required>
        <br>

        <input class="btn btn-primary" type="submit" value="Buscar" style=" width:175px;">
        <br>
    </form>

    <?php
    gerarFooter();
    ?>


    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/jquery-3.2.1.slim.min.js"></script>
</body>

</html>