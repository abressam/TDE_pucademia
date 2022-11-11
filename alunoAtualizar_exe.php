<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- medAtualizar.php --> 

<html>
	<head>
	  <title>Pucademia</title>
	  <link rel="icon" type="image/png" href="imagens/favicon.png" />
	  <meta name="viewport" content="width=device-width, initial-scale=1">
	  <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
	  <link rel="stylesheet" href="css/customize.css">
	</head>
	<body onload="w3_show_nav('menuMedico')">
	<!-- Inclui MENU.PHP  -->
	<?php require 'geral/menu.php'; ?>
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
		<div class="w3-container w3-theme">
		<h2>Atualização de Aluno</h2>
		</div>
		<!-- Acesso ao BD-->
		<?php
			// Recebe os dados que foram preenchidos no formulário, com os valores que serão atualizados
			$dataNascimento 	= $_POST["dataNascimento"];
			$id 				= $_POST["Id"];
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
			
			<?php
		
			// Faz Update na Base de Dados
			$sql = "UPDATE pessoa
					SET nome = '$nome', dataNascimento = '$dataNascimento', cpfCnpj = '$cpfCnpj', email = '$email', genero = '$genero', logradouro = '$logradouro', complemento = '$complemento', cep = '$cep', bairro = '$bairro', cidade = '$cidade', estado = '$estado'
					WHERE pessoaId = $id";	
			
			$sql2 = "UPDATE aluno
					SET peso = '$peso', objetivo = '$objetivo', altura = '$altura', restricao = '$restricao'
					WHERE pessoaId = $id";
			
			$sql3 = "UPDATE aluno_plano
					SET planoId = '$planoId', dataInicio = '$hoje'
					WHERE pessoaId = '$id' AND planoId != '$planoId'";

			if ($result = mysqli_query($conn, $sql) and $result = mysqli_query($conn, $sql2) and $result = mysqli_query($conn, $sql3)) {
				echo "<p>&nbsp;Registro alterado com sucesso! </p>";
			} else {
				echo "<p>&nbsp;Erro executando UPDATE: " . mysqli_error($conn) . "</p>";
			}

			mysqli_close($conn); //Encerra conexao com o BD

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
