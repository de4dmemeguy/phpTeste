<?php
    session_start();
    include_once("config.php");
    require_once 'vendor/autoload.php'; // Incluir o arquivo de autoload do DomPDF
    
    // Verificar se o usuário está logado
    if(!isset($_SESSION['cpf']) || !isset($_SESSION['senha'])) {
        header('Location: login.php');
        exit();
    }

    $logado = $_SESSION['cpf'];

    // Contar o total de pessoas
    $total_geral_query = "SELECT COUNT(*) AS total_geral FROM pessoa";
    $total_geral_result = mysqli_query($conexao, $total_geral_query);
    $total_geral_row = mysqli_fetch_assoc($total_geral_result);
    $total_geral = $total_geral_row['total_geral'];

    $total_pessoas = $total_geral;

    // Se o parâmetro de data estiver presente na URL, ajuste a consulta SQL do contador
    if (!empty($_GET['data'])) {
        $data = mysqli_real_escape_string($conexao, $_GET['data']);
        // Ajuste o formato da data, se necessário
        $data_formatada = date('Y-m-d', strtotime($data));
        
        $total_pessoas_query = "SELECT COUNT(*) AS total_pessoas FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";
        $total_pessoas_result = mysqli_query($conexao, $total_pessoas_query);
        $total_pessoas_row = mysqli_fetch_assoc($total_pessoas_result);
        $total_pessoas = $total_pessoas_row['total_pessoas'];
    }
    
      
    // Paginação para os resultados da busca
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
    $qnt_result_pg = 30;
    $inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;
    
    // Consulta SQL para os resultados da busca com paginação
    $result_pessoa = "";
    if (!empty($_GET['data'])) {
        $data = mysqli_real_escape_string($conexao, $_GET['data']);
        // Ajuste o formato da data, se necessário
        $data_formatada = date('Y-m-d', strtotime($data));

        $result_pessoa = "SELECT NOME, CPF, TELEFONE, NOME_FAMILIAR, VINCULO_FAMILIAR, NECES_DOC_FAMILIAR, DATE_FORMAT(data_hora_cadastro, '%d/%m/%Y %H:%i:%s') AS data_hora_cadastro FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada' LIMIT $inicio, $qnt_result_pg";
    } else {
        $result_pessoa = "SELECT NOME, CPF, TELEFONE, NOME_FAMILIAR, VINCULO_FAMILIAR, NECES_DOC_FAMILIAR, DATE_FORMAT(data_hora_cadastro, '%d/%m/%Y %H:%i:%s') AS data_hora_cadastro FROM pessoa LIMIT $inicio, $qnt_result_pg";
    }
    
    $resultado_pessoa = mysqli_query($conexao, $result_pessoa);

    // Definir o total de pessoas de acordo com os resultados da busca
    
?>
<!DOCTYPE html>
<html lang="pt-br">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.7.2/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <title>Listar</title>
  </head>

  <body>
  <div class="d-flex">
      <a href="tiposConsultas.html" class="btn btn-primary" style="position: absolute; top: 20px; left: 20px; background-color: #218838;"><i class="bi bi-arrow-left"></i>Tipos de Listagens</a>
  </div>
  <div class="d-flex">
      <a href="sair.php" class="btn btn-danger" style="position: absolute; top: 20px; right: 20px;">Sair</a>
  </div>
    <br>
    <h1 class="text-center">Listagem de Pessoas</h1>
    <br>
    <h4 class="" style="position: absolute; left: 20px;">Total de Pessoas: <?php echo $total_pessoas; ?></h4>
            <div>
                <!-- Adicione o formulário de pesquisa por data -->
                <form method="GET" action="listar3.php">
                    <label for="data"; style="position: absolute; right:265px;">Pesquisar por Data:</label>
                    <input type="date" id="data" name="data" style="position: absolute; right:120px;">
                    <button type="submit" class="btn btn-outline-primary" style="position: absolute; top: 100px; right: 20px;">Pesquisar</button>
                </form>
            </div>
    <br>
    <br>
    <?php
        if (isset ($_SESSION['msg'])){
            echo $_SESSION['msg'];
            unset ($_SESSION ['msg']);
        }

        
            echo "<div class='table-responsive'>";
            echo "<table class='table table-bordered table-striped table-hover'>";
            echo "<thead class='thead-dark'>";
            echo "<tr>";
            
            echo "<th scope='col'>NOME</th>";
            echo "<th scope='col'>CPF</th>";
            echo "<th scope='col'>TELEFONE</th>";
            echo "<th scope='col'>NOME FAMILIAR</th>";
            echo "<th scope='col'>VINCULO FAMILIAR</th>";
            echo "<th scope='col'>DOCUMENTACAO FAMILIAR</th>";
            echo "<th scope='col'>DATA / HORA</th>";
            echo "</tr>";
            echo "</thead>";
            echo "<tbody>";

        while ($row_pessoa = mysqli_fetch_assoc($resultado_pessoa)){
            echo "<tr>";
            
            echo "<td>" . $row_pessoa['NOME'] . "</td>";
            echo "<td>" . $row_pessoa['CPF'] . "</td>";
            echo "<td>" . $row_pessoa['TELEFONE'] . "</td>";
            echo "<td>" . $row_pessoa['NOME_FAMILIAR'] . "</td>";
            echo "<td>" . $row_pessoa['VINCULO_FAMILIAR'] . "</td>";
            echo "<td>" . $row_pessoa['NECES_DOC_FAMILIAR'] . "</td>";
            echo "<td>" . $row_pessoa['data_hora_cadastro'] . "</td>";
            echo "</tr>";
        }

        echo "</tbody>";
        echo "</table>";
        echo "</div>";
            

        // Paginação para os resultados da busca
        if (!empty($_GET['data'])) {
            $quantidade_pg = ceil($total_pessoas / $qnt_result_pg);
        } else {
            $quantidade_pg = ceil($total_geral / $qnt_result_pg);
        
        }

        //Limitar os Links antes e depois
        $max_links = 2;

    ?>
        <div class="d-flex justify-content-center">
        <a href='listar3.php?<?php echo (!empty($_GET['data']) ? "data=".$_GET['data']."&" : "")."pagina=1"; ?>' class='btn btn-outline-primary'>Primeira </a>
    <?php

        for($pag_ant = $pagina - $max_links; $pag_ant <= $pagina -1; $pag_ant ++)
        {
            if($pag_ant >= 1 )
            {
                echo "<a href='listar3.php?".(!empty($_GET['data']) ? "data=".$_GET['data']."&" : "")."pagina=$pag_ant'>$pag_ant </a>";
            }
            

        }
        echo "$pagina ";

        for($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep ++)
        {
            if($pag_dep <= $quantidade_pg)
            {
                echo "<a href='listar3.php?".(!empty($_GET['data']) ? "data=".$_GET['data']."&" : "")."pagina=$pag_dep'>$pag_dep </a>";
            }
        }
        echo "<a href='listar3.php?".(!empty($_GET['data']) ? "data=".$_GET['data']."&" : "")."pagina=$quantidade_pg' class='btn btn-outline-primary'> Ultima</a>";

    ?>
    
    <!-- Adicionar botão para gerar PDF -->
    <form method="post" action="pdf_listar3.php">
        <input type="hidden" name="data" value="<?php echo isset($_GET['data']) ? $_GET['data'] : ''; ?>">
        <button type="submit" class="btn btn-primary" style="position: absolute; top: 20px; right: 80px;">Gerar PDF</button>
    </form>
</div>
        
        <br><br>
  </body>

</html>
