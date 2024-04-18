<?php
require_once "config.php";

// Receber valores
$nome = $cpf = $telefone = $escolaridade = $end_rua = $end_num = $end_bairro = $data_nasc = "";

if(isset($_POST["CPF"]) && !empty($_POST["CPF"])) {

    $cpf = $_POST["cpf"];

    if ($stmt = msqli_prepare($link, $sql)) {
        mysqli_stmt_param($stmt, "sssi", $param_nome, $param_cpf, $param_telefone, $param_escolaridade, $param_end_rua, $param_end_num, $param_end_bairro, $param_data_nasc);

        $param_nome = $nome;
        $param_cpf = $cpf;
        $param_data_nasc = $data_nasc;
        $param_end_bairro = $end_bairro;
        $param_end_num = $end_num;
        $param_end_rua = $end_rua;
        $param_escolaridade = $escolaridade;
        $param_telefone = $telefone;

        if (mysqli_stmt_execute($stmt)) {
            
            header("location: listar1.php");
            exit();
        } else {
            echo "Algo deu errado! Tente novamente."
        }
    }

    mysqli_stmt_close($stmt);

}

mysqli_close($link);

else {
    
    if (isset($_GET["CPF"]) && !empty(trim($_GET["CPF"]))) {
        
        $cpf = trim($_GET["CPF"]);

        $sql = "SELECT * FROM pessoa WHERE CPF = ?";
        if($stmt = mysqli_prepare($link, $sql)) {
            mysqli_stmt_bind_param($stmt, "i", $param_cpf);
        }
    }
}