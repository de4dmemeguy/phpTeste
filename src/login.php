<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link rel="shortcut icon" href="/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon" />
  <!-- <link rel="stylesheet" href="/CidadaniaEseguranca/src/css/login.css" />  -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

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

    .verdEsc {
      color: #333333;
    }
  </style>

</head>

<body style="background-color: rgba(79, 149, 161, 0.2863);">

  <nav class="navbar">
    <div class="container-fluid">
      <form class="d-flex">
        <a href="home.php" class="btn btn-warning fw-medium">Voltar para a HOME</a>
      </form>
    </div> 
  </nav> 

  <main class="container">

    <form action="/CidadaniaEseguranca/src/testeLogin.php" method="post" class="mx-3 mb-5 mt-5">

      <div class="container mx-auto border rounded-4 col-12 col-md-8 col-xl-4 shadow-lg" style="background-color: white;">

      <div class="text-center mb-3 mt-4">
      <img src="/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" alt="logo-ssp" style="width: 90px;">
    </div>
        <h1 class="text-center mt-4 verdEsc">Bem-vindo(a)</h1>
        <p class="text-center mb-4 verdEsc">Insira seu dados de acesso</p>

        <form action="" method="post">

          <div class="mb-3 col-12 col-md-10 mx-auto">
            <label for="" class="form-label fw-semibold">CPF:</label>
            <div class="input-group mb-3">
              <span class="input-group-text" id="basic-addon1"><i class="bi bi-person-fill"></i></span>
              <input type="text" id="cpf" name="cpf" class="form-control left-border-none" placeholder="000.000.000.-00">
            </div>
          </div>
          <div class="mb-4 col-12 col-md-10 mx-auto">
            <label for="" class="form-label fw-semibold">Senha:</label>
            <div class="input-group mb-4">
              <span class="input-group-text" id="basic-addon1"><i class="bi bi-key-fill"></i></span>
              <input type="password" name="senha" class="form-control" placeholder="Digite sua senha" />
            </div>
          </div>
          <div class="d-grid gap-2 col-12 col-md-10 mx-auto mb-3">
            <input class="btn mb-3 text-light fw-medium" type="submit" name="submit" value="Entrar" style="background-color: #37808d;">
          </div>


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
      </div>

      <!-- <a href="home.php" class="btn btn-warning btn-lg btn-sm d-block d-md-none" style="position: absolute; top: 20px; right: 20px; padding: 12px 20px;">Voltar para a HOME</a>
      <a href="home.php" class="btn btn-warning btn-lg d-none d-md-block" style="position: absolute; top: 20px; right: 20px; padding: 12px 20px;">Voltar para a HOME</a> -->



    </form>


  </main>

  <!-- <main class="login">

    <div class="logo">
      <img src="/CidadaniaEseguranca/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" alt="logo-ssp">
    </div>
    <form action="/CidadaniaEseguranca/CidadaniaEseguranca/src/testeLogin.php" method="post" class="container-login">


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


          Bibliteca de máscaras
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


  </main> -->


</body>

</html>