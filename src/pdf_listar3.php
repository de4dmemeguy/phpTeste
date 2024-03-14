<?php
require_once 'config.php';
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;

// Verificar se o usuário está logado
session_start();
if (!isset($_SESSION['cpf']) || !isset($_SESSION['senha'])) {
    header('Location: login.php');
    exit();
}

// Consulta SQL para buscar todos os dados de acordo com a data (se houver)
//$conexao = mysqli_connect("localhost", "root", "", "database");
$data = isset($_POST['data']) ? $_POST['data'] : null;
if ($data) {
    $data_formatada = date('Y-m-d', strtotime($data));
    $query = "SELECT * FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";

    // Contar o total de pessoas da busca
    $total_pessoas_query = "SELECT COUNT(*) AS total_pessoas FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";
} else {
    $query = "SELECT * FROM pessoa";

    // Contar o total de pessoas
    $total_pessoas_query = "SELECT COUNT(*) AS total_pessoas FROM pessoa";
}

$resultado = mysqli_query($conexao, $query);

// Total de pessoas da busca
$total_pessoas_result = mysqli_query($conexao, $total_pessoas_query);
$total_pessoas_row = mysqli_fetch_assoc($total_pessoas_result);
$total_pessoas = $total_pessoas_row['total_pessoas'];

// Inicializar o Dompdf
$dompdf = new Dompdf();

// Construir HTML para o PDF
$html = '<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Pessoas</title>
    <style>
        body {
            font-size: 10pt; /* Definindo o tamanho da fonte para 10pt */
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    <h1 style="text-align: center;">Listagem de Pessoas</h1>';

// Verificar se a pesquisa foi feita por data e adicionar o texto informativo
if ($data) {
    $html .= '<strong style="font-size: 12; color: blue;">Dados Cadastrados em: ' . date('d/m/Y', strtotime($data)) . '</strong>';
}

$html .= '<div>
       <strong style="font-size: 12; color: blue;">Total Registros: ' . $total_pessoas. ' </strong>
    </div>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>NOME</th>
                <th>CPF</th>
                <th>TELEFONE</th>
                <th>NOME FAMILIAR</th>
                <th>VINCULO</th>
                <th>DOCUMENTACAO FAMILIAR</th>
            </tr>
        </thead>
        
        <tbody>';

while ($row = mysqli_fetch_assoc($resultado)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['NOME'] . '</td>';
    $html .= '<td>' . $row['CPF'] . '</td>';
    $html .= '<td>' . $row['TELEFONE'] . '</td>';
    $html .= '<td>' . $row['NOME_FAMILIAR'] . '</td>';
    $html .= '<td>' . $row['VINCULO_FAMILIAR'] . '</td>';
    $html .= '<td>' . $row['NECES_DOC_FAMILIAR'] . '</td>';
    $html .= '</tr>';
}

$html .= '</tbody>
    </table>
    
</body>
</html>';

// Carregar HTML no Dompdf e gerar PDF
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'landscape');
$dompdf->render();

// Gerar o nome do arquivo PDF
$pdf_nome = 'lista_Familiar.pdf';

// Baixar o PDF
$dompdf->stream($pdf_nome, array('Attachment' => 0));
