<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon" />
  <link rel="stylesheet" href="/CidadaniaEseguranca/src/css/login.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <title>Cidadania e Segurança- Login</title>

  <style>
  .inputSubmit{
      width: 256px;
        border-radius: 4px ;
        font-weight: 600;
        background-color:#37808d;
        color: white;
        padding: 8px;
        cursor: pointer;
        border: none;
     }
     </style>

</head>

<body>

  <main class="login">
      <div class="logo">
        <img src="/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" alt="logo-ssp">
      </div>



    <form action="testeLogin.php" method="post" class="container-login">
      <h1 class="login-title">Bem-vindo(a)</h1>
      <h2 class="login-subtitle">Insira seu dados de acesso</h2>
      
      
      <div class="login-form">
        <form action="" method="post">
          <i class="bx bxs-user"></i>
          <label for="" class="label-form">CPF:</label>
          <input type="text" name="cpf" class="input-form" placeholder="Digite seu CPF" />
          <i class="bx bxs-key"></i>
          <label for="" class="label-form">Senha:</label>
          <input type="password" name="senha" class="input-form" placeholder="Digite sua senha" />
          <br>
          <input class="inputSubmit" type="submit" name="submit" value="Entrar">
        </form>

      </div>
    
    </form>

    
  </main>

</body>

</html>