<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="/CidadaniaEseguranca/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon" />
  <!-- <link rel="stylesheet" href="/CidadaniaEseguranca/CidadaniaEseguranca/src/css/login.css"> -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
  <title>Cidadania e Segurança - Login</title>
</head>
<style>
  .dark-green {
    color: #135763;
  }

  .bg-white {
    background-color: white;
  }

  .logo {
    width: 90px;
  }

  .bg-dark-green {
    background-color: #37808d;
  }

  .bg-dark-green:hover {
    background-color: #135763
  }

  body {
    background-color: rgba(79, 149, 161, 0.2863);
  }
</style>

<body>

  <nav class="navbar">
    <div class="container-fluid justify-content-end mt-2">
      <a href="home.php" class="btn btn-warning">Voltar para a HOME</a>
    </div>
  </nav>

  <div class="container">

    <form action="/CidadaniaEseguranca/CidadaniaEseguranca/src/testeLogin.php" method="post" class="mx-3 mb-5 mt-5">

      <div class="container mx-auto border rounded-4 col-12 col-md-8 col-xl-4 shadow-lg bg-white">

        <div class="text-center mb-3 mt-4">
          <img src="/CidadaniaEseguranca/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" alt="logo-ssp" class="logo">
        </div>
        <h1 class="text-center mt-4 dark-green">Bem-vindo(a)</h1>
        <p class="text-center mb-4 dark-green">Insira seu dados de acesso</p>

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
            <input class="btn mb-3 text-light fw-medium bg-dark-green" type="submit" name="submit" value="Entrar">
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

    </form>
  </div>

</body>

</html>
