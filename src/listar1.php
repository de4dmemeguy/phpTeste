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
$total_geral_query = "SELECT COUNT(*) AS total_geral FROM pessoa";
$total_geral_result = mysqli_query($conexao, $total_geral_query);
$total_geral_row = mysqli_fetch_assoc($total_geral_result);
$total_geral = $total_geral_row['total_geral'];

$total_pessoas = $total_geral;

// Defina o número de resultados por página
$qnt_result_pg = 30;

// Paginação para os resultados da busca
$pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
$pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;
$inicio = ($qnt_result_pg * $pagina) - $qnt_result_pg;

// PAGINAÇÃO POR NOME
if (!empty($_GET['nome'])) {
    $nome = mysqli_real_escape_string($conexao, $_GET['nome']);

    // Consulta SQL para contar o número total de pessoas com o nome buscado
    $total_pessoas_query = "SELECT COUNT(*) AS total_pessoas FROM pessoa WHERE NOME LIKE '%$nome%'";
    $total_pessoas_result = mysqli_query($conexao, $total_pessoas_query);
    $total_pessoas_row = mysqli_fetch_assoc($total_pessoas_result);
    $total_pessoas = $total_pessoas_row['total_pessoas'];

    $quantidade_pg = ceil($total_pessoas / $qnt_result_pg);
    $pagina_atual = filter_input(INPUT_GET, 'pagina', FILTER_SANITIZE_NUMBER_INT);
    $pagina = (!empty($pagina_atual)) ? $pagina_atual : 1;

    if ($pagina > $quantidade_pg) {
        header("Location: listar3.php?" . (!empty($_GET['nome']) ? "nome=$nome&" : "") . "pagina=$quantidade_pg");
        exit;
    }
} else {
    $quantidade_pg = 0;
}

// PAGINAÇÃO POR DATA
if (!empty($_GET['data'])) {
    $data = mysqli_real_escape_string($conexao, $_GET['data']);
    // Ajuste o formato da data, se necessário
    $data_formatada = date('Y-m-d', strtotime($data));

    $total_pessoas_query = "SELECT COUNT(*) AS total_pessoas FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";
    $total_pessoas_result = mysqli_query($conexao, $total_pessoas_query);
    $total_pessoas_row = mysqli_fetch_assoc($total_pessoas_result);
    $total_pessoas = $total_pessoas_row['total_pessoas'];
} else {
    $quantidade_pg = 0;
}

// EXIBIR BUSCA
$result_pessoa = "";

if (!empty($_GET['nome'])) {
    $nome = mysqli_real_escape_string($conexao, $_GET['nome']);
    $result_pessoa = "SELECT IDPESSOA, NOME, CPF, DATA_NASC, END_RUA, END_NUM, END_BAIRRO, TELEFONE, ESCOLARIDADE FROM pessoa WHERE NOME LIKE '%$nome%'";
} elseif (!empty($_GET['data'])) {
    $data = mysqli_real_escape_string($conexao, $_GET['data']);
    $data_formatada = date('Y-m-d', strtotime($data));
    $result_pessoa = "SELECT IDPESSOA, NOME, CPF, DATA_NASC, END_RUA, END_NUM, END_BAIRRO, TELEFONE, ESCOLARIDADE FROM pessoa WHERE DATE(data_hora_cadastro) ";
} else {
    $result_pessoa = "SELECT IDPESSOA, NOME, CPF, DATA_NASC, END_RUA, END_NUM, END_BAIRRO, TELEFONE, ESCOLARIDADE FROM pessoa";
}

$result_pessoa .= " LIMIT $inicio, $qnt_result_pg";

$resultado_pessoa = mysqli_query($conexao, $result_pessoa);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
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


    <!-- Adicione o formulário de pesquisa por data -->
    <div class="container w-75">
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form method="GET" action="listar3.php">
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
        <!-- formulário de pesquisa por nome -->
        <div class="row">
            <div class="col-md-6 mx-auto">
                <form method="GET" action="listar1.php">
                    <div class="mb-3">
                        <label for="data" class="form-label">Pesquise por nome</label>
                        <div class="input-group">
                            <input type="text" class="form-control" name="nome" id="nome" placeholder="Digite o nome" aria-label="Recipient's username" aria-describedby="button-addon2" href='$result_pessoa_nome'>
                            <button class="btn btn-outline-primary" type="submit" id="button-addon2">Pesquisar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <br>
    <div class="container">
        <div class="row">
            <?php
            if (isset($_GET['delete']) && $_GET['delete']) {

            ?>
                <div class="alert alert-success w-75 mx-auto" role="alert">
                    <i class="bi bi-check-circle-fill"></i> Apagado com sucesso
                </div>
            <?php

            }
            ?>
        </div>
        <div class="col">
            <div class="text-sm overflow-auto">
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
                echo "<th scope='col'>NASCIMENTO</th>";
                echo "<th scope='col'>NOME RUA</th>";
                echo "<th scope='col'>NUM</th>";
                echo "<th scope='col'>BAIRRO</th>";
                echo "<th scope='col'>TELEFONE</th>";
                echo "<th scope='col'>ESCOLARIDADE</th>";
                echo "<th scope='col'>EDITAR</th>";
                echo "<th scope='col'>EXCLUIR</th>";

                echo "</tr>";
                echo "</thead>";
                echo "<tbody>";

                while ($row_pessoa = mysqli_fetch_assoc($resultado_pessoa)) {
                    echo "<tr>";

                    echo "<td>" . $row_pessoa['NOME'] . "</td>";
                    echo "<td>" . $row_pessoa['CPF'] . "</td>";
                    echo "<td>" . $row_pessoa['DATA_NASC'] . "</td>";
                    echo "<td>" . $row_pessoa['END_RUA'] . "</td>";
                    echo "<td>" . $row_pessoa['END_NUM'] . "</td>";
                    echo "<td>" . $row_pessoa['END_BAIRRO'] . "</td>";
                    echo "<td>" . $row_pessoa['TELEFONE'] . "</td>";
                    echo "<td>" . $row_pessoa['ESCOLARIDADE'] . "</td>";
                    echo "<td class='text-center'><a href='form_edit.php?idpessoa=" . $row_pessoa['IDPESSOA'] . "'><i class='bi bi-pencil-square text-primary'></a></i></td>";
                    echo "<td class='text-center'><a href='javascript:alertDelete(" . $row_pessoa['IDPESSOA'] . ")'><i class='bi bi-trash text-danger'></a></i></td>";


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
                    <li class="page-item"><a href='listar1.php?<?php echo (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . "pagina=1"; ?>' class='page-link'>Primeira </a></li>
                    <?php

                    for ($pag_ant = $pagina - $max_links; $pag_ant <= $pagina - 1; $pag_ant++) {
                        if ($pag_ant >= 1) {
                            echo "<li class='page-item'><a class='page-link' href='listar1.php?" . (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . (!empty($_GET['nome']) ? "nome=" . $_GET['nome'] . "&" : "") ."pagina=$pag_ant'>$pag_ant </a></li>";
                        }
                    }
                    echo "<li class='page-item active'> <a class='page-link' href='#'>$pagina</a></li>";

                    for ($pag_dep = $pagina + 1; $pag_dep <= $pagina + $max_links; $pag_dep++) {
                        if ($pag_dep <= $quantidade_pg) {
                            echo "<li class='page-item'><a class='page-link' href='listar1.php?" . (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . (!empty($_GET['nome']) ? "nome=" . $_GET['nome'] . "&" : "") . "pagina=$pag_dep'>$pag_dep </a></li>";
                        }
                    }
                    echo "<li class='page-item'><a href='listar1.php?" . (!empty($_GET['data']) ? "data=" . $_GET['data'] . "&" : "") . (!empty($_GET['nome']) ? "nome=" . $_GET['nome'] . "&" : "") . "pagina=$quantidade_pg' class='page-link'> Ultima</a></li>";

                    ?>
                </ul>
            </nav>


        <!-- Adicionar botão para gerar PDF -->
        <form method="post" action="pdf_listar1.php">
            <input type="hidden" name="nome" value="<?php echo isset($_GET['nome']) ? $_GET['nome'] : ''; ?>">
            <button type="submit" class="btn btn-primary" style="position: absolute; top: 8px; right: 80px;">Gerar PDF</button>
        </form>
    </div>

    <br><br>

    <script>
        function alertDelete(id) {
            if (confirm("Confirma a exclusão?") == true) {
                window.location.href = "delete.php?nome=" + id;
            }
        }
    </script>
</body>

</html>