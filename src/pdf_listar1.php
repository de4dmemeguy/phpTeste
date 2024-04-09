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

$data = isset($_POST['data']) ? $_POST['data'] : null;
if ($data) {
    $data_formatada = date('Y-m-d', strtotime($data));
    $query = "SELECT DISTINCT NOME, CPF, DATA_NASC, END_RUA, END_NUM, END_BAIRRO, TELEFONE, ESCOLARIDADE, DATE_FORMAT(data_hora_cadastro, '%d/%m/%Y %H:%i:%s') AS data_hora_cadastro FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";

    // Contar o total de pessoas da busca
    $total_pessoas_query = "SELECT COUNT(DISTINCT NOME) AS total_pessoas FROM pessoa WHERE DATE(data_hora_cadastro) = '$data_formatada'";
} else {
    $query = "SELECT DISTINCT NOME, CPF, DATA_NASC, END_RUA, END_NUM, END_BAIRRO, TELEFONE, ESCOLARIDADE, DATE_FORMAT(data_hora_cadastro, '%d/%m/%Y %H:%i:%s') AS data_hora_cadastro FROM pessoa";

    // Contar o total de pessoas
    $total_pessoas_query = "SELECT COUNT(DISTINCT NOME) AS total_pessoas FROM pessoa";
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
    <title>Listagem de Pessoas</title>
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
                <th>NASCIMENTO</th>
                <th>RUA</th>
                <th>NUM</th>
                <th>BAIRRO</th>
                <th>TELEFONE</th>
                <th>ESCOLARIDADE</th>
                
            </tr>
        </thead>
        
        <tbody>';

while ($row = mysqli_fetch_assoc($resultado)) {
    $html .= '<tr>';
    $html .= '<td>' . $row['NOME'] . '</td>';
    $html .= '<td>' . $row['CPF'] . '</td>';
    $html .= '<td>' . $row['DATA_NASC'] . '</td>';
    $html .= '<td>' . $row['END_RUA'] . '</td>';
    $html .= '<td>' . $row['END_NUM'] . '</td>';
    $html .= '<td>' . $row['END_BAIRRO'] . '</td>';
    $html .= '<td>' . $row['TELEFONE'] . '</td>';
    $html .= '<td>' . $row['ESCOLARIDADE'] . '</td>';
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
$pdf_nome = 'listagem_pessoas.pdf';

// Baixar o PDF
$dompdf->stream($pdf_nome, array('Attachment' => 0));
