

<link rel="stylesheet" href="css/cadastro.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">

<a href="home.php">Sair</a>
<div class="title">
    <h3>Formulário - Cidadania e Segurança</h3>
  </div>

<form action="#" id="myForm">
<div class="container-enc">
<div class="mb-3"> 
    <h5 class="sub-title">Encaminhamentos</h5>
    <div class="">
      <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoCNI"   class="form-check-input"/>
      <label for="encaminhamentoCNI">CPF</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoRCN"  class="form-check-input" />
      <label for="encaminhamentoRCN">RCN</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoCarteiraCIPTEA"  class="form-check-input" />
      <label for="encaminhamentoCarteiraCIPTEA">Carteira CIPTEA</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoCarteiraPCD"  class="form-check-input"/>
      <label for="encaminhamentoCarteiraPCD">Carteira Do Idoso</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="insercaoAtualizacaoCADUNICO" class="form-check-input" />
      <label for="insercaoAtualizacaoCADUNICO">Inserção/Atualização CADÚNICO</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="projetoPermanecerSEDUC" class="form-check-input" />
      <label for="projetoPermanecerSEDUC">Projeto Permanecer - SEDUC (em casos de evasão escolar)</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="cursosCapacitacaoProfissional" class="form-check-input" />
      <label for="cursosCapacitacaoProfissional">Cursos de Defesa Pessoal Para Mulheres</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="cursosCapacitacaoProfissional" class="form-check-input" />
      <label for="cursosCapacitacaoProfissional">Programa Empreender no Envelhecer (em casos de microcrédito para idoso)</label>
    </div>
    <div>
      <input type="radio" name="encaminhamentosAgendados" id="cursosCapacitacaoProfissional" class="form-check-input" />
      <label for="cursosCapacitacaoProfissional">Idoso em Movimento(em caso de atividade físicas em grupos de idosos)</label>
    </div>
    <br>
    <div class="mb-3">
          <label for="nomeCompletoTec" class="form-label">Nome completo do Técnico:</label>
          <input type="text" id="nomeCompletoTec" name="nomeCompletoTec" class="form-control" required/>
      </div>
  </div>
  <input type="submit" name="submit" id="submit">
  <!-- <button type="submit">Enviar</button> -->
  <!-- <button><a href="">Enviar</a></button> -->
</div> 
</form>