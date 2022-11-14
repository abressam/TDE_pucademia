<!DOCTYPE html>
<html>
	<head>

	  <title>Pucademia</title>
	  <link rel="icon" type="image/png" href="imagens/favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customizes.css">
	</head>
<body onload="w3_show_nav('menuAcademia')">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php';?>
<?php require 'bd/conectaBD.php'; ?>
<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

<div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
  <p class="w3-large">
  <div class="w3-code cssHigh notranslate">
  <!-- Acesso em:-->
	<?php

	date_default_timezone_set("America/Sao_Paulo");
	$data = date("d/m/Y H:i:s",time());
	echo "<p class='w3-small' > ";
	echo "Acesso em: ";
	echo $data;
	echo "</p> "
	?>

	<!-- Acesso ao BD-->
	<?php
		$dataNascimento 	= $_POST["dataNascimento"];
		$genero 			= $_POST["genero"];
		$planoId 			= $_POST["planoId"];
		$peso 				= $_POST["peso"];
		$objetivo 			= $_POST["objetivo"];
		$altura 			= $_POST["altura"];
		$restricao 			= $_POST["restricao"];
		$nome 				= $_POST["nome"];
		$cpfCnpj 			= $_POST["cpfCnpj"];
		$email 				= $_POST["email"];
		$logradouro 		= $_POST["logradouro"];
		$complemento 		= $_POST["complemento"];
		$cep 				= $_POST["CEP"];
		$bairro 			= $_POST["bairro"];
		$cidade 			= $_POST["cidade"];
		$estado 			= $_POST["estado"];
		$hoje 				= date('Y/m/d H:i');		
		 
		// Cria conexão
		$conn = mysqli_connect($servername, $username, $password, $database);

		// Verifica conexão
		if (!$conn) {
			die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
		}
		// Configura para trabalhar com caracteres acentuados do português
		mysqli_query($conn,"SET NAMES 'utf8'");
		mysqli_query($conn,'SET character_set_connection=utf8');
		mysqli_query($conn,'SET character_set_client=utf8');
		mysqli_query($conn,'SET character_set_results=utf8');

		?>
		<div class='w3-responsive w3-card-4'>
		<div class="w3-container w3-theme">
		<h2>Inclusão de Novo Aluno</h2>
		</div>
		<?php
		
		// Faz INSERT na Base de Dados
		
		$sql = "INSERT INTO Pessoa (nome, cpfCnpj, email, dataNascimento, genero, logradouro, complemento, cep, bairro, cidade, estado) VALUES
		('$nome', '$cpfCnpj', '$email', '$dataNascimento', '$genero', '$logradouro', '$complemento', '$cep', '$bairro', '$cidade', '$estado');
		SELECT LAST_INSERT_ID() AS pessoaId;
		";

		mysqli_multi_query($conn, $sql);
		mysqli_next_result($conn);

		
		if ($result = mysqli_store_result($conn)) {
			$row = mysqli_fetch_assoc($result);
			$pessoaId = $row["pessoaId"];

			$sql2 = "INSERT INTO aluno (pessoaId, peso, objetivo, altura, restricao) VALUES ('$pessoaId', '$peso', '$objetivo', '$altura', '$restricao')";

			$sql3 = "INSERT INTO aluno_plano (pessoaId, planoId, dataInicio) VALUES ('$pessoaId', '$planoId', '$hoje')";

			if ($result = mysqli_query($conn, $sql2) and $result = mysqli_query($conn, $sql3)) {
				echo "<p>&nbsp;Registro cadastrado com sucesso! </p>";
			} else {
				echo "<p>&nbsp;Erro executando INSERT: " . mysqli_error($conn . "</p>");
			}
		} else {
			echo "<p>&nbsp;Erro executando INSERT: " . mysqli_error($conn . "</p>");
		}
			echo "</div>";
			mysqli_close($conn);  //Encerra conexao com o BD
	?>
  </div>
</div>


	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>
	
</body>
</html>
