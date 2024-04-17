<?php
session_start();
include_once("config.php");
require_once 'vendor/autoload.php'; // Incluir o arquivo de autoload do DomPDF

// Verificar se o usuário está logado
if (!isset($_SESSION['cpf']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}

$logado = $_SESSION['cpf'];

// Contar o total de pessoas
$total_geral_query = "SELECT COUNT(distinct nome) AS total_geral FROM pessoa";
$total_geral_result = mysqli_query($conexao, $total_geral_query);
$total_geral_row = mysqli_fetch_assoc($total_geral_result);
$total_geral = $total_geral_row['total_geral'];

$total_pessoas = $total_geral;

// Se o parâmetro de data estiver presente na URL, ajuste a consulta SQL do contador
if (!empty($_GET['data'])) {
    $data = mysqli_real_escape_string($conexao, $_GET['data']);
    // Ajuste o formato da data, se necessário
    $data_formatada = date('Y-m-d', strtotime($data));

    $total_pessoas_query = "SELECT COUNT(distinct nome) AS total_geral FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";
    $total_pessoas_result = mysqli_query($conexao, $total_pessoas_query);
    $total_pessoas_row = mysqli_fetch_assoc($total_pessoas_result);
    $total_pessoas = $total_pessoas_row['total_geral'];
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

    $result_pessoa = "SELECT NOME, MIN(CPF) AS CPF, MIN(TELEFONE) AS TELEFONE, MIN(DOCUM_CIVIL) AS DOCUM_CIVIL, MIN(ENCAMINHAMENTOS) AS ENCAMINHAMENTOS 
                            FROM pessoa 
                            WHERE DATE(data_hora_cadastro) = '$data_formatada' 
                            GROUP BY NOME 
                            LIMIT $inicio, $qnt_result_pg";
} else {
    $result_pessoa = "SELECT NOME, MIN(CPF) AS CPF, MIN(TELEFONE) AS TELEFONE, MIN(DOCUM_CIVIL) AS DOCUM_CIVIL, MIN(ENCAMINHAMENTOS) AS ENCAMINHAMENTOS 
                            FROM pessoa 
                            GROUP BY NOME 
                            LIMIT $inicio, $qnt_result_pg";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <title>Listar</title>
</head>

<body>

    <nav class="navbar bg-body-tertiary">
        <form class="container-fluid justify-content-between">
            <a href="tiposConsultas.html" class="btn btn-success"><i class="bi bi-arrow-left"></i> Tipos de Listagens</a>
            <a href="sair.php" class="btn btn-danger">Sair</a>
        </form>
    </nav>

    <h1 class="text-center mt-4 mb-5">Listagem de Pessoas</h1>

    <!-- Formulário de pesquisa por data -->
    <div class="container w-75">
        <div class="row ">
            <div class="col-md-6 mx-auto">
                <form method="GET" action="listar2.php">
                    <div class="mb-3">
                        <label for="data" class="form-label">Pesquise por data</label>
                        <div class="input-group mb-1">
                            <input type="date" id="data" name="data" class="form-control">
                            <button type="submit" class="btn btn-outline-primary">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Formulário de pesquisa por nome -->
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form action="">
                    <div class="mb-3">
                        <label for="data" class="form-label">Pesquise por nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Digite o nome" aria-label="Recipient's username" aria-describedby="button-addon2">
                            <button class="btn btn-outline-primary" type="button" id="button-addon2">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <br>

    <div class="container">
        <div class="row">
            <div class="row">
                <h4 class="text-start d-none d-xl-block">Total de Pessoas: <?php echo $total_pessoas; ?></h4>
                <h5 class="text-start d-block d-xl-none">Total de Pessoas: <?php echo $total_pessoas; ?></h5>
            </div>
            <div class="col">
                <div class="overflow-auto">
                    <?php
                    if (isset($_SESSION['msg'])) {
                        echo $_SESSION['msg'];
                        unset($_SESSION['msg']);
                    }


                    echo "<div class='table-responsive'>";
                    echo "<table class='table table-bordered table-striped table-hover'>";
                    echo "<thead class='thead-dark'>";
                    echo "<tr>";

                    echo "<th scope='col'>NOME</th>";
                    echo "<th scope='col'>CPF</th>";
                    echo "<th scope='col'>TELEFONE</th>";
                    echo "<th scope='col'>DOCUMENTAÇÃO CIVIL</th>";
                    echo "<th scope='col'>ENCAMINHAMENTOS</th>";
                    echo "<th scope='col'>EDITAR</th>";
                    echo "<th scope='col'>EXCLUIR</th>";
                    echo "</tr>";
                    echo "</thead>";
                    echo "<tbody>";

                    while ($row_pessoa = mysqli_fetch_assoc($resultado_pessoa)) {
                        echo "<tr>";

                        echo "<td>" . $row_pessoa['NOME'] . "</td>";
                        echo "<td>" . $row_pessoa['CPF'] . "</td>";
                        echo "<td>" . $row_pessoa['TELEFONE'] . "</td>";
                        echo "<td>" . $row_pessoa['DOCUM_CIVIL'] . "</td>";
                        echo "<td>" . $row_pessoa['ENCAMINHAMENTOS'] . "</td>";
                        echo "<td class='text-center'><a href=''><i class='bi bi-pencil-square text-primary'></a></i></td>";
                        echo "<td class='text-center'><a href=''><i class='bi bi-trash text-danger'></a></i></td>";
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
                </div>
            </div>
        </div>
    </div>



    <div class="d-flex justify-content-center mt-2">
        <nav aria-label="navegação da página">
            <ul class="pagination">
                <li class="page-item"><a href='listar2.php?<?php echo (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . "pagina=1"; ?>' class='page-link'>Primeira </a></li>

                <?php

                for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                    if ($pag_ant >= 1) {
                        echo "<li class='page-item'><a class='page-link' href='listar2.php?" . (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . "pagina=$pag_ant'>$pag_ant </a></li>";
                    }
                }
                echo "<li class='page-item active'> <a class='page-link' href='#'>$pagina</a></li>";

                for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                    if ($pag_dep <= $quantidade_pg) {
                        echo "<li class='page-item'><a class='page-link' href='listar2.php?" . (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . "pagina=$pag_dep'>$pag_dep </a></li>";
                    }
                }
                echo "<li class='page-item'><a href='listar2.php?" . (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . "pagina=$quantidade_pg' class='page-link'> Ultima</a></li>";

                ?>
            </ul>
    </div>
    <!-- Adicionar botão para gerar PDF -->
    <form method="post" action="pdf_listar2.php">
        <input type="hidden" name="data" value="<?php echo isset($_GET['data']) ? $_GET['data'] : ''; ?>">
        <button type="submit" class="btn btn-primary" style="position: absolute; top: 8px; right: 80px;">Gerar PDF</button>
    </form>


    <br><br>
</body>

</html>