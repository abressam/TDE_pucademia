<!DOCTYPE html>
<!-------------------------------------------------------------------------------
    Desenvolvimento Web
    PUCPR
    Profa. Cristina V. P. B. Souza
    Agosto/2022
---------------------------------------------------------------------------------->
<!-- medListar.php -->

<html>
<head>
    <title>Clínica Médica ABC</title>
    <link rel="icon" type="image/png" href="imagens/favicon.png"/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="css/customize.css">
</head>
<body  onload="w3_show_nav('menuMedico')">
<!-- Inclui MENU.PHP  -->
<?php require 'geral/menu.php'; ?>
<?php require 'bd/conectaBD.php'; ?>

<!-- Conteúdo Principal: deslocado para direita em 270 pixels quando a sidebar é visível -->
<div class="w3-main w3-container" style="margin-left:270px;margin-top:117px;">

    <div class="w3-panel w3-padding-large w3-card-4 w3-light-blue">
        <p class="w3-large">
        <p>
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
            <div class="w3-container w3-red">
			<h2>Listagem de Alunos</h2>
			</div>

            <!-- Acesso ao BD-->
            <?php

                // Cria conexão
                $conn = mysqli_connect($servername, $username, $password, $database);
                
                // Verifica conexão 
                if (!$conn) {
                    echo "</table>";
                    echo "</div>";
                    die("Falha na conexão com o Banco de Dados: " . mysqli_connect_error());
                }
                
                // Configura para trabalhar com caracteres acentuados do português
                mysqli_query($conn,"SET NAMES 'utf8'");
                mysqli_query($conn,'SET character_set_connection=utf8');
                mysqli_query($conn,'SET character_set_client=utf8');
                mysqli_query($conn,'SET character_set_results=utf8');

                // Faz Select na Base de Dados
// ---------------> Email foi adicionado após Dt_Nasc
                $sql = "SELECT p.pessoaId, p.cpfCnpj, p.email, p.dataNascimento, p.genero, p.nome, p.cep, a.matricula, a.peso, a.objetivo, a.altura, a.restricao FROM pessoa AS p INNER JOIN aluno AS a ON (p.pessoaId = a.pessoaId) ORDER BY p.pessoaId";
                echo "<div class='w3-responsive w3-card-4'>";
                if ($result = mysqli_query($conn, $sql)) {
                    echo "<table class='w3-table-all'>";
                    echo "	<tr>";
                    echo "	  <th width='7%'>ID</th>";
                    echo "	  <th width='7%'>Nome</th>";
                    echo "	  <th width='7%'>Idade</th>";
                    echo "	  <th width='7%'>CPF/CNPJ</th>";
                    echo "	  <th width='7%'>Matrícula</th>";
                    echo "	  <th width='7%'>Peso</th>";
                    echo "	  <th width='7%'>Altura</th>";
                    echo "	  <th width='15%'>Objetivo</th>";
                    echo "	  <th width='15%'>Restrição</th>";
                    // echo "	  <th width='8%'>Idade</th>";
                    // echo "	  <th width='10%'>Email</th>";
                    // echo "	  <th width='7%'> </th>";
                    // echo "	  <th width='7%'> </th>";
                    echo "	</tr>";
                    if (mysqli_num_rows($result) > 0) {
                        // Apresenta cada linha da tabela
                        while ($row = mysqli_fetch_assoc($result)) {
                            // $data = $row['Dt_Nasc'];
                            $dataNascimento = $row["dataNascimento"];
                            list($ano, $mes, $dia) = explode('-', $dataNascimento);
                            // $nova_data = $dia . '/' . $mes . '/' . $ano;
                            // data atual
                            $hoje = mktime(0, 0, 0, date('m'), date('d'), date('Y'));
                            // Descobre a unix timestamp da data de nascimento do fulano
                            $nascimento = mktime( 0, 0, 0, $mes, $dia, $ano);
                            // cálculo
                            $idade = floor((((($hoje - $nascimento) / 60) / 60) / 24) / 365.25);
                            $id = $row["pessoaId"];
                            $matricula = $row["matricula"];
                            $peso = $row["peso"];
                            $objetivo = $row["objetivo"];
                            $altura = $row["altura"];
                            $restricao = $row["restricao"];
                            $nome = $row["nome"];
                            $cpfCnpj = $row["cpfCnpj"];
                            
                            // $cod = $row["ID_Medico"];
                            echo "<tr>";
                            echo "<td>";
                            echo $id;
                            echo "</td><td>";
                            echo $nome;
                            echo "</td><td>";
                            echo $idade;
                            echo "</td><td>";
                            echo $cpfCnpj;
                            echo "</td><td>";
                            echo $matricula;
                            echo "</td><td>";
                            echo $peso;
                            echo "</td><td>";
                            echo $altura;
                            echo "</td><td>";
                            echo $objetivo;
                            echo "</td><td>";
                            echo $restricao;
                            echo "</td>";
// -----------------------> Email foi adicionado após idade
                            // echo $row["Email"];
                            // echo "</td>";
                            //Atualizar e Excluir registro de médicos
            ?>              
                            <!-- <td>       
                            <a href='medAtualizar.php?id=<?php echo $cod; ?>'><img src='imagens/Edit.png' title='Editar Médico' width='32'></a>
                            </td><td>
                            <a href='medExcluir.php?id=<?php echo $cod; ?>'><img src='imagens/Delete.png' title='Excluir Médico' width='32'></a>
                            </td> -->
                            </tr>
            <?php
                        }
                    }
                        echo "</table>";
                        echo "</div>";
                } else {
                    echo "Erro executando SELECT: " . mysqli_error($conn);
                }

                mysqli_close($conn);

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
