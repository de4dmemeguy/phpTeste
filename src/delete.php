<?php
    session_start();
    include_once("config.php");

    if(!isset($_SESSION['cpf']) || !isset($_SESSION['senha'])) {
        header('Location: login.php');
        exit();
    }

    if (mysqli_query($conexao, 'DELETE FROM pessoa WHERE IDPESSOA = ' . $_GET['idpessoa'])) {
        header('Location: listar1.php?delete=1');
        header('Location: listar2.php?delete=2');
        header('Location: listar3.php?delete=3');
    } else {
        header('Location: listar1.php?delete=0');
        header('Location: listar2.php?delete=0');
        header('Location: listar3.php?delete=0');
    }
