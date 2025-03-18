<?php

function gerarTitulo()
{
    echo '
    <div class="header">
        <img src="/assets/cindactai.png" style="margin-left: 10px;">
        <h1>Sistema de Ordens de Serviço (SISOS SRO) </h1>
        <img src="/assets/dom_dtcea.png" style="margin-right: 10px;">
    </div>
    ';
}

function gerarHeader()
{
    echo '
    <div class="header">
        <img src="/assets/cindactai.png" style="margin-left: 10px;">
        <h1>Sistema de Cadastro de Hidrômetros (SICHS SRO) </h1>
        <img src="/assets/dom_dtcea.png" style="margin-right: 10px;">
    </div>
    ';
}

function gerarFooter()
{
    echo '
    <div class="footer-main"></div>
    <div class="footer">
		Copyright ¢ 2019 Destacamento de Controle do Espaço Aéreo de São Roque
		<br>
		Desenvolvido por S2 João Eduardo de Moraes e S2 Thomas Janoski Soares da Silveira
	</div>
    ';
}
function gerarHeaderComMenu()
{
    echo '
    <div class="header">
        <img src="/assets/cindactai.png" style="margin-left: 10px;">
        <h1>Sistema de Cadastro de Hidrômetros (SICHS SRO) </h1>
        <img src="/assets/dom_dtcea.png" style="margin-right: 10px;">   
    </div>
    <nav class="menu">
        <ul>
            <li><a href="/hidro/menu.php">Inicio</a></li>
            <li><a href="/hidro/cad_hid.php">Hidrômetros</a></li>
            ]<li><a href="/hidro/cad_militares.php">Militares</a></li>
            <li><a href="/hidro/rel_individual.php">Relatório Indivídual</a></li>
			<li><a href="/hidro/busca_rel_geral.php">Relatório Geral</a></li>
            <li><a href="/login">Sair</a></li>
        </ul>
    </nav>
    ';
}