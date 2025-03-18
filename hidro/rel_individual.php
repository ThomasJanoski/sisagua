<?php
session_start();
include_once("./../lib/conexao.php");
include_once("./../lib/gerarHeader.php");
include_once("./../lib/hidrometro.php");
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <title>Relatório Indivídual - Hidrômetros</title>
    <link rel="icon" type="image.ico" href="fav.ico" />

    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/css/general.css" rel="stylesheet">
</head>

<body>
    <?php
    gerarHeaderComMenu();
    ?>

    <br>
    <h2 class="title">Relatório Individual de Hidrômetros</h2>
    <br>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }

    $hidrometroSelecionado = filter_input(INPUT_GET, 'hidrometro_selecionado');
    $hidrometroSelecionado = (!empty($hidrometroSelecionado)) ? $hidrometroSelecionado : "hidrometros";

    $idHidrometroSelecionado = sprintf("id%s", $hidrometroSelecionado);

    //Receber o número da página
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

    //Setar a quantidade de itens por pagina
    $qnt_result_pg = 5;

    //calcular o inicio visualização
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

    $result_usuarios = "SELECT * FROM $hidrometroSelecionado ORDER BY $idHidrometroSelecionado DESC LIMIT $inicio, $qnt_result_pg";
    $resultado_usuarios = mysqli_query($conn, $result_usuarios);
    ?>
    <div class="container col-md-6">
        <label class="form-label" for="hidrometro">Hidrômetro</label>
        <?php
        gerarSelectHidrometro($hidrometroSelecionado);
        ?>
    </div>
    <br><br>

    <?php
    echo "<div class='container col-md-6'>";
    while ($row_usuario = mysqli_fetch_assoc($resultado_usuarios)) {
        echo gerarRelatorioHidrometro(
            $row_usuario['nomecoletor'],
            $row_usuario['hidrometro'],
            $row_usuario['total'],
            $row_usuario['datacoleta'],
            $row_usuario['horacoleta'],
            $row_usuario['hid_cal'],
            $row_usuario['observacoes']
        );
    }
    echo "</div>";
    //Paginação - Somar a quantidade de usuários
    $result_pg = "SELECT COUNT($idHidrometroSelecionado) AS num_result FROM $hidrometroSelecionado";
    $resultado_pg = mysqli_query($conn, $result_pg);
    $row_pg = mysqli_fetch_assoc($resultado_pg);
    //echo $row_pg['num_result'];
    //Quantidade de pagina 
    $quantidade_pg = ceil($row_pg['num_result'] / $qnt_result_pg);

    //Limitar os link antes depois
    $max_links = 2;
    echo "<div class='container d-flex justify-content-center'>";
    echo "<a class='link-dark link-offset-2 p-1' href='rel_individual.php?pagina=1&hidrometro_selecionado=$hidrometroSelecionado'>Primeira</a> ";

    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
        if ($pag_ant >= 1) {
            echo "<a class='link-success link-offset-2 p-1' href='rel_individual.php?pagina=$pag_ant&hidrometro_selecionado=$hidrometroSelecionado'>$pag_ant</a> ";
        }
    }

    echo "<p class='p-1'>$pagina</p>";

    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
        if ($pag_dep <= $quantidade_pg) {
            echo "<a class='link-success link-offset-2 p-1' href='rel_individual.php?pagina=$pag_dep&hidrometro_selecionado=$hidrometroSelecionado'>$pag_dep</a> ";
        }
    }

    echo "<a class='link-dark link-offset-2 p-1' href='rel_individual.php?pagina=$quantidade_pg&hidrometro_selecionado=$hidrometroSelecionado'>Última</a>";
    echo "</div>";
    gerarFooter();
    ?>

    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/js/rel_individual.js"></script>
</body>

</html>