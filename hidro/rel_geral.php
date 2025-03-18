<?php
include_once("./../lib/conexao.php");
include_once("./../lib/gerarHeader.php");
include_once("./../lib/hidrometro.php");

session_start();
$hidrometroSelecionado = $_POST["hidrometro"];
$idHidrometroSelecionado = sprintf("id%s", $hidrometroSelecionado);
$datainicio = $_POST['datainicio'];
$datafinal = $_POST['datafinal'];
$result_efetivo = "SELECT * FROM $hidrometroSelecionado WHERE datacoleta BETWEEN '$datainicio' AND '$datafinal' ORDER BY datacoleta DESC"
;
$resultado_efetivo = mysqli_query($conn, $result_efetivo); ?>
<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Relatório Geral - Hidrômetros</title>

	<link rel="icon" type="image.ico" href="fav.ico" />

	<link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link href="/css/general.css" rel="stylesheet">
</head>

<body>
	<?php
	gerarHeaderComMenu();

	echo sprintf(
		'<br><h2 class="title"> Relatório Geral do %s</h2><br><br>',
		pegarNomeHidrometro($hidrometroSelecionado)
	);
	?>

	<form action="gerarpdf_geral.php">
		<input type="date" name="datainicio" value="<?php echo $datainicio ?>" hidden>
		<input type="date" name="datafinal" value="<?php echo $datafinal ?>" hidden>
		<input type="text" name="hidrometro" value="<?php echo $hidrometroSelecionado ?>" hidden>

		<div class="text-center">
			<input class="btn btn-primary" type="submit" value="Imprimir">
		</div>
		<br>
	</form>

	<div class="container col-md-6">
		<hr><br>

		<?php
		while ($row_usuario = mysqli_fetch_assoc($resultado_efetivo)) {
			echo gerarRelatorioHidrometro(
				$row_usuario['nomecoletor'],
				$row_usuario['hidrometro'],
				$row_usuario['total'],
				$row_usuario['datacoleta'],
				$row_usuario['horacoleta'],
				$row_usuario['hid_cal'],
				$row_usuario['observacoes'],
			);
		}
		?>

		<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
		<script src="/js/jquery-3.2.1.slim.min.js"></script>
</body>

</html>