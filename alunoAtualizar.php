<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- MedAtualizar.php -->

<html>
	<head>
		<title>IE - Instituição de Ensino</title>
		<link rel="icon" type="image/png" href="imagens/IE_favicon.png"/>
		<meta name="viewport" content="width=device-width, initial-scale=1">
		<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
		<link rel="stylesheet" href="css/customize.css">
	</head>
<body onload="w3_show_nav('menuMedico')" >
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
				$data = date("d/m/Y H:i:s", time());
				echo "<p class='w3-small' > ";
				echo "Acesso em: ";
				echo $data;
				echo "</p> "
				?>

				<!-- Acesso ao BD-->
				<?php		
				$id = $_GET['id'];

				// Cria conexão
				$conn = mysqli_connect($servername, $username, $password, $database);

				// Verifica conexão
				if (!$conn) {
					die("<strong> Falha de conexão: </strong>" . mysqli_connect_error());
				}
				// Configura para trabalhar com caracteres acentuados do português	 
				mysqli_query($conn, "SET NAMES 'utf8'");
				mysqli_query($conn, 'SET character_set_connection=utf8');
				mysqli_query($conn, 'SET character_set_client=utf8');
				mysqli_query($conn, 'SET character_set_results=utf8');
				
				// Faz Select na Base de Dados
				$sql = "SELECT p.pessoaId, p.cpfCnpj, p.email, p.dataNascimento, p.genero, p.nome, p.logradouro, p.complemento, p.cep, p.bairro, p.cidade, p.estado, a.matricula, a.peso, a.objetivo, a.altura, ap.planoId, a.restricao 
                        FROM pessoa AS p 
                            INNER JOIN aluno AS a ON (p.pessoaId = a.pessoaId)
                            INNER JOIN aluno_plano as ap ON (ap.pessoaId = a.pessoaId)
                        WHERE p.pessoaId = $id";

				//Inicio DIV form
				echo "<div class='w3-responsive w3-card-4'>";
				if ($result = mysqli_query($conn, $sql)) {
					if(mysqli_num_rows($result) == 1){
						$row = mysqli_fetch_assoc($result);
						
						$dataNascimento 	= $row["dataNascimento"];
						$id 				= $row["pessoaId"];
						$matricula 			= $row["matricula"];
						$planoId 			= $row["planoId"];
						$peso 				= $row["peso"];
						$objetivo 			= $row["objetivo"];
						$altura 			= $row["altura"];
						$restricao 			= $row["restricao"];
						$nome 				= $row["nome"];
						$cpfCnpj 			= $row["cpfCnpj"];
						$email 				= $row["email"];
						$genero 			= $row["genero"];
						$logradouro 		= $row["logradouro"];
						$complemento 		= $row["complemento"];
						$cep 				= $row["cep"];
						$bairro 			= $row["bairro"];
						$cidade 			= $row["cidade"];
						$estado 			= $row["estado"];

									
						// Faz Select na Base de Dados
						$sqlG = "SELECT nome, planoId FROM plano";
							
						$optionsEspec = array();
						
						if ($result = mysqli_query($conn, $sqlG)) {
							while ($row = mysqli_fetch_assoc($result)) {
								$selected = "";
								if ($row['planoId'] == $planoId)
									$selected = "selected";
								array_push($optionsEspec, "\t\t\t<option " . $selected . " value='". $row["planoId"] ."'>". $row["nome"] ."</option>\n");
							}
						}

						?>
						<div class="w3-container w3-theme">
							<h2>Altere os dados do aluno com a matrícula <?php echo $matricula; ?></h2>
						</div>
						<form class="w3-container" action="alunoAtualizar_exe.php" method="post" enctype="multipart/form-data">
							<table class='w3-table-all flex-container'>
								<tr>
									<td style="width:50%;">

									<input type="hidden" id="Id" name="Id" value="<?php echo $id; ?>">

									<label class="w3-text-IE"><b>Nome</b></label>
									<input class="w3-input w3-border w3-light-grey " name="nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" placeholder="Informe um nome..." title="Nome entre 10 e 100 letras." value="<?php echo $nome; ?>" required></p>


									<label class="w3-text-IE"><b>Data de nascimento</b>*</label>
									<input class="w3-input w3-border w3-light-grey " name="dataNascimento" id="dataNascimento"  type="date" maxlength="15" placeholder="dd/mm/aaaa" title="dd/mm/aaaa" value="<?php echo $dataNascimento; ?>" required></p>

									
									<label class="w3-text-IE"><b>Plano</b>*</label>
									<select name="planoId" id="planoId" class="w3-input w3-border w3-light-grey " required>
									<?php
										foreach($optionsEspec as $key => $value){
											echo $value;
										}
									?>
									</select></p>

									<label class="w3-text-IE"><b>CPF/CNPJ</b></label>
									<input class="w3-input w3-border w3-light-grey " name="cpfCnpj" type="text" title="CPF/CNPJ" placeholder="Informe um CPF/CNPJ..." value="<?php echo $cpfCnpj; ?>" required></p>

									<label class="w3-text-IE"><b>Email</b></label>
									<input class="w3-input w3-border w3-light-grey " name="email" type="email" title="Email" placeholder="Informe o email..." value="<?php echo $email; ?>" required></p>

									<label class="w3-text-IE"><b>Peso</b></label>
									<input class="w3-input w3-border w3-light-grey " name="peso" type="text" title="Peso" placeholder="Informe o peso..." value="<?php echo $peso; ?>" required></p>

									<label class="w3-text-IE"><b>Altura</b></label>
									<input class="w3-input w3-border w3-light-grey " name="altura" type="text" title="Altura" placeholder="Informe a altura..." value="<?php echo $altura; ?>" required></p>

									<label class="w3-text-IE"><b>Objetivo</b></label>
									<input class="w3-input w3-border w3-light-grey " name="objetivo" type="text" title="Objetivo" placeholder="Informe o objetivo..." value="<?php echo $objetivo; ?>" required></p>

									<label class="w3-text-IE"><b>Restrição</b></label>
									<input class="w3-input w3-border w3-light-grey " name="restricao" type="text" title="Restricao" placeholder="Informe a restrição..." value="<?php echo $restricao; ?>" required></p>

									<label class="w3-text-IE"><b>Logradouro</b></label>
									<input class="w3-input w3-border w3-light-grey " name="logradouro" type="text" title="Logradouro" placeholder="Informe um logradouro..." value="<?php echo $logradouro; ?>" required></p>

									<label class="w3-text-IE"><b>Complemento</b></label>
									<input class="w3-input w3-border w3-light-grey " name="complemento" type="text" title="Complemento" placeholder="Informe o complemento..." value="<?php echo $complemento; ?>" required></p>
								
									<label class="w3-text-IE"><b>CEP</b></label>
									<input class="w3-input w3-border w3-light-grey " name="CEP" type="text" title="CEP" placeholder="Informe um CEP..." value="<?php echo $cep; ?>" required></p>

									<label class="w3-text-IE"><b>Bairro</b></label>
									<input class="w3-input w3-border w3-light-grey " name="bairro" type="text" title="Bairro" placeholder="Informe um bairro..." value="<?php echo $bairro; ?>" required></p>

									<label class="w3-text-IE"><b>Cidade</b></label>
									<input class="w3-input w3-border w3-light-grey " name="cidade" type="text" title="Cidade" placeholder="Informe uma cidade..." value="<?php echo $cidade; ?>" required></p>

									<label class="w3-text-IE"><b>Estado</b></label>
									<input class="w3-input w3-border w3-light-grey " name="estado" type="text" title="Estado" placeholder="Informe um estado..." value="<?php echo $estado; ?>" required></p>
								</tr>

								<tr>
									<td colspan="2" style="text-align:center">
									<input type="submit" value="Alterar" class="w3-btn w3-red" >
									<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='alunoListar.php'">
								</tr>
							</table>
						<br>
						</form>
								<?php
					}else{?>
								<div class="w3-container w3-theme">
								<h2>Aluno inexistente</h2>
								</div>
								<br>
							<?php
							}
				} else {
					echo "<p style='text-align:center'>Erro executando UPDATE: " . mysqli_error($conn) . "</p>";
				}
				echo "</div>"; //Fim form
				mysqli_close($conn);  //Encerra conexao com o BD
				?>
			</div>
			</p>
		</div>

	<?php require 'geral/sobre.php';?>
	<!-- FIM PRINCIPAL -->
	</div>
	<!-- Inclui RODAPE.PHP  -->
	<?php require 'geral/rodape.php';?>

</body>
</html>
