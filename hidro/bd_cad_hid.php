<?php
session_start();
include_once("conexao.php");

$nomecoletor = filter_input(INPUT_POST, 'nomecoletor', FILTER_SANITIZE_STRING);
$hidrometro = $_POST['hidrometro'];
$val_hidrometro = $_POST['val_hidrometro'];
$datacoleta = $_POST['datacoleta'];
$horacoleta = $_POST['horacoleta'];
$total = $_POST['total'];
$observacoes = $_POST['observacoes'];
$hid_cal = $_POST['hid_cal'];


$result_usuario = "INSERT INTO $hidrometro (nomecoletor, hidrometro, datacoleta, horacoleta, total, observacoes, hid_cal) 
VALUES ('$nomecoletor', '$val_hidrometro', '$datacoleta', '$horacoleta',  '$total', '$observacoes', '$hid_cal')";

$resultado_usuario = mysqli_query($conn, $result_usuario);

if (mysqli_affected_rows($conn) != 0) {
    echo "
            <META HTTP-EQUIV=REFRESH CONTENT = '0; URL=/hidro/menu.php'>
            <script type=\"text/javascript\">
            alert (\"Salvo com Sucesso.\")
            </script>         
            ";

} else {
    $_SESSION['msg'] = "<p style='color:red;'>Hidrômetro não foi cadastrado</p>";
    header("Location: cad_hid.php");
}
