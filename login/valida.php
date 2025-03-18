<?php
session_start();
include_once("./../lib/conexao.php");

if ((isset($_POST['login'])) && (isset($_POST['senha']))) {
	$usuario = mysqli_real_escape_string($conn, $_POST['login']);
	$senha = mysqli_real_escape_string($conn, $_POST['senha']);

	//Buscar na tabela usuario o usuário que corresponde com os dados digitado no formulário
	$result_usuario = "SELECT * FROM usuarios WHERE login = '$usuario' && senha = '$senha' LIMIT 1";
	$resultado_usuario = mysqli_query($conn, $result_usuario);
	$resultado = mysqli_fetch_assoc($resultado_usuario);

	//Encontrado um usuario na tabela usuário com os mesmos dados digitado no formulário
	if (isset($resultado)) {
		$_SESSION['usuarioId'] = $resultado['id'];
		$_SESSION['usuarioNiveisAcessoId'] = $resultado['niveis_acesso_id'];
		$_SESSION['usuarioLogin'] = $resultado['login'];

		if ($_SESSION['usuarioNiveisAcessoId'] == "1") {
			header("Location: /hidro/menu.php");
		} elseif ($_SESSION['usuarioNiveisAcessoId'] == "2") {
			header("Location: /usuario/menu_user.php");
		} else {
			header("Location: index.php");
		}

	} else {
		$_SESSION['loginErro'] = "Usuário ou senha Inválido";
		header("Location: index.php");
	}
	//O campo usuário e senha não preenchido entra no else e redireciona o usuário para a página de login
} else {
	$_SESSION['loginErro'] = "Usuário ou senha inválido";
	header("Location: index.php");
}
?>