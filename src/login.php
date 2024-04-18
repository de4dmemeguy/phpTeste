<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon" />
  <link rel="stylesheet" href="/CidadaniaEseguranca/src/css/login.css" />
  <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Cidadania e Segurança - Login</title>

  <style>
    .inputSubmit {
      width: 256px;
      border-radius: 4px;
      font-weight: 600;
      background-color: #37808d;
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
    <form action="/CidadaniaEseguranca/src/testeLogin.php" method="post" class="container-login">


      <h1 class="login-title">Bem-vindo(a)</h1>
      <h2 class="login-subtitle">Insira seu dados de acesso</h2>


      <div class="login-form">
        <form action="" method="post">
          <i class="bx bxs-user"></i>
          <label for="" class="label-form">CPF:</label>
          <input type="text" id="cpf" name="cpf" class="input-form" placeholder="000.000.000.-00" />
          <i class="bx bxs-key"></i>
          <label for="" class="label-form">Senha:</label>
          <input type="password" name="senha" class="input-form" placeholder="Digite sua senha" />
          <br>
          <input class="inputSubmit" type="submit" name="submit" value="Entrar">


          <!-- Bibliteca de máscaras -->
          <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
          <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

          <script>
            $(document).ready(function() {
              // Máscara para CPF
              $('#cpf').mask('000.000.000-00', {
                reverse: true
              });
            });
          </script>
        </form>
        <a href="home.php" class="btn btn-warning btn-lg btn-sm d-block d-md-none" style="position: absolute; top: 20px; right: 20px; padding: 12px 20px;">Voltar para a HOME</a>
        <a href="home.php" class="btn btn-warning btn-lg d-none d-md-block" style="position: absolute; top: 20px; right: 20px; padding: 12px 20px;">Voltar para a HOME</a>

      </div>

    </form>


  </main>


</body>

</html>