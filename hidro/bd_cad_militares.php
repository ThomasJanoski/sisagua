<?php

include_once("./../lib/conexao.php");

$posto = $_GET['posto'];
$especialidade = $_GET['especialidade'];
$nomecomp = sprintf("%s %s", $especialidade, $_GET['nomecomp']);
$saram = $_GET['saram'];
$ultimaPromocao = $_GET['ultimapromocao'];

$query_militar = "INSERT INTO militares (posto, nomecomp, saram, ultimapromocao) VALUES ('$posto', '$nomecomp', $saram, '$ultimaPromocao')";
$resultado_militar = mysqli_query($conn, $query_militar);

if (mysqli_affected_rows($conn) != 0) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0; URL=/hidro/cad_militares.php'>
            <script type=\"text/javascript\">
            alert (\"Cadastrado com sucesso.\")
            </script>         
            ";

} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Militar não foi cadastrado</div>";
    header("Location: cad_militares.php");
}
