<?php

include_once("./../lib/conexao.php");

$id_militar = $_GET['id_militar'];

$query_militar = "DELETE FROM militares WHERE idmilitares = $id_militar";
$resultado_militar = mysqli_query($conn, $query_militar);

if (mysqli_affected_rows($conn) != 0) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0; URL=/hidro/cad_militares.php'>
            <script type=\"text/javascript\">
            alert (\"Excluído com sucesso.\")
            </script>         
            ";

} else {
    $_SESSION['msg'] = "<div class='alert alert-danger'>Militar não foi deletado</div>";
    header("Location: cad_militares.php");
}
