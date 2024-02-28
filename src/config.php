<?php

    $dbHost = 'Localhost';
    $dbUsername = 'root';
    $dbPassword = '@itamarati30';
    $dbName = 'cidadania_seguranca';

    // $dbHost = 'Localhost';
    // $dbUsername = 'ssp';
    // $dbPassword = '@SSP2019ra';
    // $dbName = 'cidadania_seguranca';


    $conexao = new mysqli($dbHost, $dbUsername, $dbPassword, $dbName);

    // if($conexao->connect_errno)
    // {
    //     echo "Erro";
    // }
    // else
    // {
    //     echo "Conexão efetuada com sucesso";
    // }

    // define('HOST', 'localhost');
    // define('DATABASENAME', 'cidadania_seguranca');
    // define('USER', 'root');
    // define('PASSWORD', '@itamarati30');

    // class Connect{
    //     protected $connection;

    //     function __construct()
    //     {
    //         $this->connectDatabase();
    //     }

    //     function connectDatabase()
    //     {
    //         try
    //         {
    //             $this->connection = new PDO('mysql:host='.HOST.';dbname='.DATABASENAME, USER, PASSWORD);
    //         }
    //         catch (PDOException $e)
    //         {
    //              echo "Error!".$e->getMessage();
    //         }
    //     }

    // }

    
?>