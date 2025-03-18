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

    <title>Cadastro de Hidrometros</title>
    <link rel="icon" type="image.ico" href="fav.ico" />

    <link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="/css/general.css">
</head>

<body>
    <?php
    gerarHeaderComMenu();
    ?>
    <br>
    <h2 class="title">Cadastro de Hidrômetros</h2>

    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>

    <br>
    <div class="container col-md-6">
        <form method="POST" action="bd_cad_hid.php">
            <input type="text" hidden id="ultimo_hidrometro" value="">

            <label class="form-label" for="nomecoletor">Nome do Coletor</label>
            <select class="form-select" name="nomecoletor" required>
                <option value="" disabled selected hidden>Selecione o Coletor</option>
                <?php
                $result_militares = "SELECT * FROM militares order by idmilitares";
                $resultado_militares = mysqli_query($conn, $result_militares);
                while ($row_militares = mysqli_fetch_assoc($resultado_militares)) { ?>
                    <option value="<?php echo $row_militares['nomecomp']; ?>">
                        <?php echo $row_militares['nomecomp']; ?>
                    </option> <?php
                }

                ?>
            </select>
            <br>

            <label class="form-label" for="hidrometro">Hidrômetro</label>
            <?php
            gerarSelectHidrometro();
            ?>

            <label class="form-label">Hidrometro Atual</label>
            <input class="form-control" type="text" name="val_hidrometro" id="val_hidrometro" required
                OnKeyUp="trocaHidrometro(this)" value="0.000">
            <br>

            <label class="form-label">Total de M³ gasto</label>

            <div class="alert alert-info" id="total"></div>
            <div class="alert alert-danger" id="resultado"></div>

            <?php
            $hoje = date('Y-m-d'); // Data atual
            $inicioDoAno = date('Y') . '-01-01'; // Primeiro dia do ano
            $fimDoAno = date('Y') . '-12-31'; // Último dia do ano
            ?>

            <label class="form-label">Data</label>
            <input class="form-control" type="date" name="datacoleta" placeholder="Selecione a Data"
                value="<?php echo $hoje; ?>" min="<?php echo $inicioDoAno; ?>" max="<?php echo $fimDoAno; ?>" required>
            <br>

            <label class="form-label">Hora da Coleta</label>
            <input class="form-control" type="text" name="horacoleta" OnKeyUp="mascara_hora(this.value)" maxlength="5"
                id="horachegax" oninput="calcular()" value="" placeholder="Digite a hora (hh:mm)" required>
            <br>

            <input type='hidden' name='hid_cal' id='hid_cal'>
            <br>

            <label class="form-label" for="observacoes">Observações</label>
            <textarea class="form-control" rows="8" cols="60" maxlength="200" name="observacoes"
                placeholder="Digite a Observação"></textarea>

            <br>

            <input class="btn btn-primary" type="submit" value="Salvar" style="width: 175px;">
        </form>
    </div>
    <br>

    <?php
    gerarFooter();
    ?>

    <script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/js/jquery-3.2.1.slim.min.js"></script>
    <script src="/js/cad_hid.js"></script>
</body>

</html>