<?php
include_once "./../lib/conexao.php";
include_once "./../lib/gerarHeader.php";
?>

<html lang="pt-br">

<head>
	<meta charset="UTF-8">
	<title> Menu SICHS VRSD </title>

	<link rel="icon" type="image.ico" href="fav.ico" />
	<link href="/vendor/twbs/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<link rel="stylesheet" href="/css/general.css">
	<link rel="stylesheet" href="/css/menu.css">
</head>

<body>
	<?php
	gerarHeaderComMenu();
	?>
	<br>
	<h2 class="hid_desc text-style">

		<?php
		$result_usuario = "SELECT * FROM hidrometros ORDER BY idhidrometros DESC limit 1";
		$resultado_usuario = mysqli_query($conn, $result_usuario);

		if (($resultado_usuario) and ($resultado_usuario->num_rows != 0)) {
			while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
				$result = $row_usuario['datacoleta'];

				echo "Ultima Atualização: " . $result;
			}
		}

		?>
	</h2>
	<?php

	$images = [
		'Normal' => './../assets/bolaverde.png',
		'Pouco Acima do Normal' => './../assets/bolalaranja.png',
		'Acima do Normal' => './../assets/bolavermelha.png',
	];

	$result_usuario = "SELECT * FROM hidrometros ORDER BY idhidrometros DESC limit 1";
	$resultado_usuario = mysqli_query($conn, $result_usuario);

	if (($resultado_usuario) and ($resultado_usuario->num_rows != 0)) {
		while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
			$result = $row_usuario['hid_cal'] == "" ? "Normal" : $row_usuario["hid_cal"];

			echo '<h2 class="hid01 hid_desc">01: ';
			echo "<img src='" . $images[$result] . "'/></h2>";
		}

	}

	for ($i = 2; $i <= 11; $i++) {
		$query = sprintf("SELECT * FROM hidrometro%02d ORDER BY idhidrometro%02d DESC LIMIT 1", $i, $i);
		$resultado_usuario = mysqli_query($conn, $result_usuario);

		if (($resultado_usuario) and ($resultado_usuario->num_rows != 0)) {
			while ($row_usuario = mysqli_fetch_assoc($resultado_usuario)) {
				$result = $row_usuario['hid_cal'] == "" ? "Normal" : $row_usuario["hid_cal"];

				echo sprintf('<h2 class="hid%02d hid_desc">%02d: ', $i, $i);
				echo "<img src='" . $images[$result] . "'/></h2>";
			}
		}

	}

	?>

	<br><br><br><br><br>
	<br><br><br><br><br>

	<h4 class="text-style">
		<img src='./../assets/bolaverde.png' />Normal<br>
		<img src='./../assets/bolalaranja.png' />Pouco Acima do Normal<br>
		<img src='./../assets/bolavermelha.png' />Acima do Normal<br>
	</h4>

	<br>

	<?php
	gerarFooter();
	?>
	<script src="/vendor/twbs/bootstrap/dist/js/bootstrap.min.js"></script>
	<script src="/js/jquery-3.2.1.slim.min.js"></script>
</body>

</html>