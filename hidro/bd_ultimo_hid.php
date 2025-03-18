<?php
include_once "./../lib/conexao.php";

if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["hidrometro_selecionado"])) {

    $hidrometroSelecionado = $_POST["hidrometro_selecionado"];
    $nomeIdHidrometro = sprintf("id%s", $hidrometroSelecionado);


    // Busca o último valor gerado para o hidrômetro
    $stmt = $conn->prepare("SELECT hidrometro FROM $hidrometroSelecionado ORDER BY $nomeIdHidrometro DESC LIMIT 1");
    $stmt->execute();
    $stmt->bind_result($ultimoValor);
    $stmt->fetch();

    if (isset($ultimoValor)) {
        echo htmlspecialchars($ultimoValor);
    } else {
        echo "Nenhum valor encontrado";
    }

    $stmt->close();
    $conn->close();
}