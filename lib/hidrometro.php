<?php

function pegarNomeHidrometro($hidrometroSelecionado)
{
    $nomesFormatados = [
        "hidrometros" => "Hidrômetro 1 (Principal)",
        "hidrometro02" => "Hidrômetro 2",
        "hidrometro03" => "Hidrômetro 3",
        "hidrometro04" => "Hidrômetro 4",
        "hidrometro05" => "Hidrômetro 5",
        "hidrometro06" => "Hidrômetro 6",
        "hidrometro07" => "Hidrômetro 7",
        "hidrometro08" => "Hidrômetro 8",
        "hidrometro09" => "Hidrômetro 9",
        "hidrometro10" => "Hidrômetro 10",
        "hidrometro11" => "Hidrômetro 11",
    ];

    return $nomesFormatados[$hidrometroSelecionado];
}

function gerarSelectHidrometro($nomeHidrometro = null)
{
    echo '<select class="form-select" name="hidrometro" id="hidrometro" required onchange="trocaHidrometroSelecionado(this.value)">';
    echo sprintf(
        '<option value="hidrometros" %s>Hidrômetro 1 (Principal)</option>',
        $nomeHidrometro == "hidrometros" ? "selected" : ""
    );

    for ($i = 2; $i <= 11; $i++) {
        $hidrometro = sprintf("hidrometro%02d", $i);
        echo sprintf('<option value="%s" %s>Hidrômetro %d</option>', $hidrometro, $nomeHidrometro == $hidrometro ? "selected" : "", $i);
    }

    echo '</select><br>';
}
function gerarRelatorioHidrometro($nomeColetor, $hidrometro, $total, $datacoleta, $horacoleta, $hid_cal, $observacoes)
{
    return sprintf('
			<div class="container-fluid d-flex flex-column">
		<div class="text-center">Nome: %s</div>
		<div class="container-fluid">
			<div class="d-inline-block p-0 m-0" style="width: 49%%;">Hidrômetro: %s</div>
			<div class="d-inline-block text-end p-0 m-0 float-right" style="width: 48%%;">Total de M³ gasto diário: %s</div>
		</div>

		<hr class="border-success">
		<div class="container-fluid">
            <div class="d-inline-block p-0 m-0" style="width: 49%%;">Data Coletada: %s</div>
			<div class="d-inline-block text-end p-0 m-0 float-right" style="width: 48%%;">Hora Coletada: %s</div>
		</div>
		<hr class="border-success">

        <div class="text-center">Índice de gasto: %s</div>
        <div class="text-center">Observações: %s</div>

		<hr><br>
	</div>
		',
        $nomeColetor,
        $hidrometro,
        $total,
        date("d-m-Y", strtotime($datacoleta)),
        $horacoleta,
        $hid_cal,
        $observacoes
    );
}