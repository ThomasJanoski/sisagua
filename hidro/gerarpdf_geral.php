<?php

session_start();
include_once("./../lib/conexao.php");
include_once("./../lib/hidrometro.php");
include_once("./../lib/gerarPdf.php");
include_once("./../lib/hidrometro.php");

$hidrometroSelecionado = $_GET["hidrometro"];
$idHidrometroSelecionado = sprintf("id%s", $hidrometroSelecionado);

$datainicio = $_GET['datainicio'];
$datafinal = $_GET['datafinal'];

$bootstrapCss = file_get_contents(__DIR__ . '/../vendor/twbs/bootstrap/dist/css/bootstrap.min.css');

$html = sprintf('
	<!DOCTYPE html>
	<html lang="pt-BR">
	<head>
		<meta charset="UTF-8">
    	<meta name="viewport" content="width=device-width, initial-scale=1.0">

		%s
	</head>
	<body>

	<p class="text-center"><b>PRIMEIRO CENTRO INTEGRADO DE DEFESA AÉREA E CONTROLE DE TRÁFEGO AÉREO</b></p>
	<p class="text-center"><b>DESTACAMENTO DE CONTROLE DO ESPAÇO AÉREO DE SÃO ROQUE</b></p>
	<p class="text-center"><b>Relatório Individual do Sistema de Controle de Hidrômetros da VRSD</b></p>
	<br>
	<p class="text-center">Do dia %s até %s</p>

	<br><br>
	<hr>
	<div class="container-fluid">
	
	',
	sprintf("
	<style>
		@page {
    		margin-right: 20mm;
		}
		body {
        	font-family: Arial, sans-serif;
    	}
		%s
	</style>", $bootstrapCss),
	date("d-m-Y", strtotime($datainicio)),
	date("d-m-Y", strtotime($datafinal))
);

$result_efetivo = "SELECT * FROM $hidrometroSelecionado WHERE datacoleta BETWEEN '$datainicio' AND '$datafinal' ORDER BY datacoleta DESC";
$resultado_efetivo = mysqli_query($conn, $result_efetivo);
while ($row_efetivo = mysqli_fetch_assoc($resultado_efetivo)) {
	$html .= gerarRelatorioHidrometro(
		$row_efetivo['nomecoletor'],
		$row_efetivo['hidrometro'],
		$row_efetivo['total'],
		$row_efetivo['datacoleta'],
		$row_efetivo['horacoleta'],
		$row_efetivo['hid_cal'],
		$row_efetivo['observacoes'],
	);
}

$html .= '
	</div>
	</body>
	</html>
';

gerarPdf($html, sprintf("Relatório Geral - %s", pegarNomeHidrometro($hidrometroSelecionado)));