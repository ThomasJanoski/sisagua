<?php
include_once("./../lib/conexao.php");
include_once("./../lib/gerarHeader.php");
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastro de Militares</title>

    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/vendor/twbs/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/general.css">
</head>

<body>
    <?php
    gerarHeaderComMenu();
    ?>

    <br>

    <div class="container">
        <form class="container col-md-6" action="bd_cad_militares.php">
            <label class="form-label" for="posto">Posto</label>
            <select class="form-control" name="posto" required>
                <option value="" disabled selected hidden>Selecione o Posto</option>
                <option value="S1">S1</option>
                <option value="S2">S2</option>
            </select>
            <br>

            <label class="form-label" for="especialidade">Especialidade</label>
            <select class="form-control" name="especialidade" required>
                <option value="" disabled selected hidden>Selecione a Especialidade</option>
                <option value="SAD">SAD</option>
                <option value="SGS">SGS</option>
                <option value="NE">NE</option>
            </select>
            <br>

            <label class="form-label" for="nomecomp">Nome Completo</label>
            <input class="form-control" type="text" name="nomecomp" required>
            <br>

            <label class="form-label" for="saram">SARAM</label>
            <input class="form-control" type="text" name="saram" OnKeyUp="formatNumber(this)" required>
            <br>

            <?php
            $dataAtual = date("Y-m-d");
            ?>

            <label class="form-label" for="ultimapromocao">Última Promoção</label>
            <input class="form-control" type="date" name="ultimapromocao" value="<?php echo $dataAtual; ?>" required>
            <br>

            <button class="btn btn-primary" type="submit">Cadastrar</button>
        </form>

        <br>
        <hr> <br>

        <?php
        $sql = "SELECT * FROM militares ORDER BY posto ASC, ultimapromocao ASC, SARAM ASC";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<div class='d-flex flex-wrap justify-content-between'>";
            while ($row = $result->fetch_assoc()) {
                echo sprintf('
                    <div class="alert alert-dark d-flex align-items-center p-2" style="width: 30%%;" role="alert">
                        <p style="margin: 0; width: 100%%;">
                            %s %s
                            <form action="bd_del_militar.php">
                                <button type="submit" name="id_militar" value="%d" class="btn btn-danger">
                                    <i class="bi bi-trash-fill" style="float: right;"></i>
                                </button>
                            </form>
                        </p>
                    </div>
                    ', $row["posto"], $row["nomecomp"], $row["idmilitares"]);
            }
            echo "</div>";
        }
        ?>
        <?php

        ?>
    </div>

    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/js/cad_militares.js"></script>
</body>

</html>