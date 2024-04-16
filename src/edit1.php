<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Editar</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
</head>

<body>
  <div class="container w-50">

    <a href="listar1.php" class="btn btn-outline-primary mt-5"><i class="bi bi-arrow-left"></i> Voltar</a>

    <h1 class="text-center mt-3">Editar Dados</h1>

    <div class="row">
      <div class="col">
        <form class="row g-3 mt-3">
          <div class="col-md-12">
            <label for="inputEmail4" class="form-label">Nome</label>
            <input type="email" class="form-control" id="inputEmail4">
          </div>
          <div class="col-md-6">
            <label for="inputCPF" class="form-label">CPF</label>
            <input type="text" class="form-control" id="inputCPF">
          </div>
          <div class="col-md-6">
            <label for="inputAddress" class="form-label">Data de Nascimento</label>
            <input type="date" class="form-control" id="inputAddress" placeholder="1234 Main St">
          </div>
          <div class="col-md-6">
            <label for="inputCity" class="form-label">Rua</label>
            <input type="text" class="form-control" id="inputCity">
          </div>
          <div class="col-md-2">
            <label for="inputZip" class="form-label">Número</label>
            <input type="text" class="form-control" id="inputZip">
          </div>
          <div class="col-md-4">
            <label for="inputZip" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="inputZip">
          </div>
          <div class="col-md-4">
            <label for="inputZip" class="form-label">Telefone</label>
            <input type="text" class="form-control" id="inputZip">
          </div>
          <div class="col-md-8">
            <label for="inputEmail4" class="form-label">Escolaridade</label>
            <input type="email" class="form-control" id="inputEmail4">
          </div>
          <div class="col-12">
            <button type="submit" class="btn btn-success">Salvar alterações</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</body>

</html>