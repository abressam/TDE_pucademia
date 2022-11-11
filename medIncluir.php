<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- medIncluir.php -->

<html>
<head>

    <title>Pucademia</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
	
</head>
<body  onload="w3_show_nav('menuMedico')">

<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php';?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado paa direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-grey">
        <!-- h1 class="w3-xxlarge">Contratação de Médico</h1 -->
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

				$optionsGenero = array();
				$todosGeneros = array('masculino', 'feminino','nao_informado');
				$todosGenerosNome = array('Masculino', 'Feminino','Não informou');

				for ($i = 0; $i < 3; $i++) {
					array_push($optionsGenero, "\t\t\t<option " . " value='". $todosGeneros[$i] ."'>". $todosGenerosNome[$i] ."</option>\n");
				}

				// Faz Select na Base de Dados
				$sqlG = "SELECT nome, planoId FROM plano";
							
				$optionsPlano = array();
				
				if ($result = mysqli_query($conn, $sqlG)) {
					while ($row = mysqli_fetch_assoc($result)) {
						array_push($optionsPlano, "\t\t\t<option " . " value='". $row["planoId"] ."'>". $row["nome"] ."</option>\n");
					}
				}

				?>

                <div class="w3-responsive w3-card-4">
                    <div class="w3-container w3-theme">
                        <h2>Informe os dados do novo do Aluno</h2>
                    </div>
                    <form class="w3-container" action="medIncluir_exe.php" method="post" enctype="multipart/form-data">
					<table class='w3-table-all'>
						<tr>
							<td style="width:50%;">

							<label class="w3-text-IE"><b>Nome</b></label>
							<input class="w3-input w3-border w3-light-grey " name="nome" type="text" pattern="[a-zA-Z\u00C0-\u00FF ]{10,100}$" placeholder="Informe um nome..." title="Nome entre 10 e 100 letras." required></p>

							<label class="w3-text-IE"><b>Gênero</b>*</label>
							<select name="genero" id="genero" class="w3-input w3-border w3-light-grey " required>
								<?php
									foreach($optionsGenero as $key => $value){
										echo $value;
									}
								?>
							</select></p>

							<label class="w3-text-IE"><b>Data de nascimento</b>*</label>
							<input class="w3-input w3-border w3-light-grey " name="dataNascimento" id="dataNascimento"  type="date" maxlength="15" placeholder="dd/mm/aaaa" title="dd/mm/aaaa" required></p>

							
							<label class="w3-text-IE"><b>Plano</b>*</label>
							<select name="planoId" id="planoId" class="w3-input w3-border w3-light-grey " required>
							<?php
								foreach($optionsPlano as $key => $value){
									echo $value;
								}
							?>
							</select></p>

							<label class="w3-text-IE"><b>CPF/CNPJ</b></label>
							<input class="w3-input w3-border w3-light-grey " name="cpfCnpj" type="text" title="CPF/CNPJ" placeholder="Informe um CPF/CNPJ..." required></p>

							<label class="w3-text-IE"><b>Email</b></label>
							<input class="w3-input w3-border w3-light-grey " name="email" type="email" title="Email" placeholder="Informe o email..." required></p>

							<label class="w3-text-IE"><b>Peso</b></label>
							<input class="w3-input w3-border w3-light-grey " name="peso" type="text" title="Peso" placeholder="Informe o peso..." required></p>

							<label class="w3-text-IE"><b>Altura</b></label>
							<input class="w3-input w3-border w3-light-grey " name="altura" type="text" title="Altura" placeholder="Informe a altura..." required></p>

							<label class="w3-text-IE"><b>Objetivo</b></label>
							<input class="w3-input w3-border w3-light-grey " name="objetivo" type="text" title="Objetivo" placeholder="Informe o objetivo..." required></p>

							<label class="w3-text-IE"><b>Restrição</b></label>
							<input class="w3-input w3-border w3-light-grey " name="restricao" type="text" title="Restricao" placeholder="Informe a restrição..." required></p>

							<label class="w3-text-IE"><b>Logradouro</b></label>
							<input class="w3-input w3-border w3-light-grey " name="logradouro" type="text" title="Logradouro" placeholder="Informe um logradouro..." required></p>

							<label class="w3-text-IE"><b>Complemento</b></label>
							<input class="w3-input w3-border w3-light-grey " name="complemento" type="text" title="Complemento" placeholder="Informe o complemento..." required></p>
						
							<label class="w3-text-IE"><b>CEP</b></label>
							<input class="w3-input w3-border w3-light-grey " name="CEP" type="text" title="CEP" placeholder="Informe um CEP..." required></p>

							<label class="w3-text-IE"><b>Bairro</b></label>
							<input class="w3-input w3-border w3-light-grey " name="bairro" type="text" title="Bairro" placeholder="Informe um bairro..." required></p>

							<label class="w3-text-IE"><b>Cidade</b></label>
							<input class="w3-input w3-border w3-light-grey " name="cidade" type="text" title="Cidade" placeholder="Informe uma cidade..." required></p>

							<label class="w3-text-IE"><b>Estado</b></label>
							<input class="w3-input w3-border w3-light-grey " name="estado" type="text" title="Estado" placeholder="Informe um estado..." required></p>
						</tr>

						<tr>
							<td colspan="2" style="text-align:center">
							<p>
							<input type="submit" value="Salvar" class="w3-btn w3-theme" >
							<input type="button" value="Cancelar" class="w3-btn w3-theme" onclick="window.location.href='alunoListar.php'">
							</p>
							</td>
						</tr>
					</table>	
					</form>
					<br>
				</div>
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
