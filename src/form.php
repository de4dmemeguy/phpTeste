<?php
session_start();
//print_r($_SESSION);
// if((!isset($_SESSION['cpf']) == true) and (!isset($_SESSION['senha']) == true))
// {
//       unset($_SESSION['cpf']);
//       unset($_SESSION['senha']);
//       header('Location: login.php');

// }

// $logado = $_SESSION['cpf'];


if (isset($_POST['submit'])) {
  // Inclua o arquivo de configuração do banco de dados
  include_once('config.php');

  //Definir o fuso horário para o de Manaus

  date_default_timezone_set('America/Manaus');


  // Prepare a query SQL para inserção de dados
  $sql = "INSERT INTO pessoa (nome, data_nasc, cpf, numero_nis, genero, estado_civil, outro_estado_civil, 
cor_raca, nacionalidade, naturalidade, escolaridade, profissao, renda, ocupacao_profissional, outra_ocupacao, 
end_cep, end_rua, end_num, end_bairro, end_p_referencia, telefone, oferta_whatsapp, tipo_residencia, 
estrutura_residencia, outros_materiais, energia_eletrica, abast_agua, outra_forma_agua, escoa_sanitario, 
outra_forma_esgoto, beneficios_sociais, outros_beneficios, sit_cad_unico, docum_civil, 
nome_familiar, idade_familiar, vinculo_familiar, escolaridade_familiar, tipo_pcd, 
neces_doc_familiar, encaminhamentos, tecnico_responsavel, data_hora_cadastro) 
VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, 
?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";

  // Preparar a instrução SQL
  $stmt = $conexao->prepare($sql);

  // Verifica se a preparação da instrução SQL foi bem-sucedida
  if ($stmt) {

    // Obtém a data e hora atual
    $data_hora_cadastro = date('Y-m-d H:i:s');

    // Liga os parâmetros da instrução SQL aos valores dos campos do formulário
    $stmt->bind_param(
      "sssssssssssssssssssssssssssssssssssssssssss",
      $nome,
      $data_nasc,
      $cpf,
      $nis,
      $genero,
      $estado_civil,
      $outro_Estado_civil,
      $cor_raca,
      $nacionalidade,
      $naturalidade,
      $escolaridade,
      $profissao,
      $renda,
      $ocupacao_profissional,
      $outra_ocupacao,
      $cep,
      $rua,
      $numero,
      $bairro,
      $referencia,
      $telefone,
      $whatsapp,
      $tipo_reside,
      $tipo_estrut,
      $outras_estrut,
      $energia_eletrica,
      $abastece_agua,
      $outro_abastecimento,
      $escoa_sanitario,
      $outra_sanitario,
      $benef_sociais,
      $outros_beneficios,
      $cad_unico,
      $doc_civil,
      $nome_familiar,
      $idade_familiar,
      $vinculo_familiar,
      $escolaridade_familiar,
      $tipo_pcd,
      $neces_docum_familiar,
      $encaminhamentos,
      $tecnico_responsavel,
      $data_hora_cadastro
    );

    // Itera sobre os valores recebidos dos campos do formulário
    for ($i = 0; $i < count($_POST['nomesocio']); $i++) {
      // Atribui os valores dos campos do formulário às variáveis correspondentes
      $nome = $_POST['nome'];
      $data_nasc = $_POST['dataNascimento'];
      $cpf = $_POST['cpf'];
      $nis = $_POST['numNIS'];
      $genero = $_POST['genero'];
      $estado_civil = $_POST['estadoCivil'];
      $outro_Estado_civil = $_POST['outroEstadoCivil'];
      $cor_raca = $_POST['cor'];
      $nacionalidade = $_POST['nacionalidade'];
      $naturalidade = $_POST['naturalidade'];
      $escolaridade = $_POST['escolaridadepessoa'];
      $profissao = $_POST['profissao'];
      $renda = $_POST['renda'];
      $ocupacao_profissional = $_POST['ocupacao'];
      $outra_ocupacao = $_POST['outraOcupacao'];
      $cep = $_POST['cep'];
      $rua = $_POST['rua'];
      $numero = $_POST['numero'];
      $bairro = $_POST['bairro'];
      $referencia = $_POST['referencia'];
      $telefone = $_POST['telefone'];
      $whatsapp = $_POST['aceitaWhatsapp'];
      $tipo_reside = $_POST['tipoResidencia'];
      $tipo_estrut = $_POST['tipoEstrutura'];
      $outras_estrut = $_POST['outrosMateriais'];
      $energia_eletrica = $_POST['energiaEletrica'];
      $abastece_agua = $_POST['abastecimentoAgua'];
      $outro_abastecimento = $_POST['outraFormaAgua'];
      $escoa_sanitario = $_POST['escoamentoSanitario'];
      $outra_sanitario = $_POST['outraFormaEsgoto'];
      $benef_sociais = $_POST['beneficiosSociais'];
      $outros_beneficios = $_POST['outroBeneficio'];
      $cad_unico = $_POST['situacaoCadastroUnico'];
      $doc_civil = $_POST['documentacaocivil'];
      // Verificar se $encaminhamentos é uma matriz antes de usar implode()
      if (is_array($doc_civil)) {
        // Se for uma matriz, use implode() para concatenar os valores
        $doc_civil = implode(',', $doc_civil);
      }

      // Campos relacionados ao familiar
      $nome_familiar = $_POST['nomesocio'][$i];
      $idade_familiar = $_POST['idadesocio'][$i];
      $vinculo_familiar = $_POST['relacao'][$i];
      $escolaridade_familiar = $_POST['escolaridadeFam'][$i];
      $tipo_pcd = $_POST['deficiencia'][$i];
      $neces_docum_familiar = $_POST['documentacao'][$i];

      // Campos relacionados aos Encaminhamentos
      $encaminhamentos = $_POST['encaminhamentosAgendados'];
      // Verificar se $encaminhamentos é uma matriz antes de usar implode()
      if (is_array($encaminhamentos)) {
        // Se for uma matriz, use implode() para concatenar os valores
        $encaminhamentos = implode(',', $encaminhamentos);
      }

      $tecnico_responsavel = $_POST['nomeCompletoTec'];

      // Executa a instrução SQL
      $stmt->execute();
    }

    // Fecha a instrução SQL
    $stmt->close();
  } else {
    echo "Erro na preparação da instrução SQL: " . $conexao->error;
  }

  // Fecha a conexão com o banco de dados
  $conexao->close();

  // Redireciona para a página de confirmação após o envio do formulário
  header("Location: formulario_enviado.php");
  exit;
}
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="shortcut icon" href="/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
  <link rel="import" href="cadastro.html">
  <!-- <link rel="stylesheet" href="/CidadaniaEseguranca/CidadaniaEseguranca/src/css/styles.css"/> -->


  <script src="./services/form.js" defer></script>
  <title>Cidadania e Segurança</title>

</head>

<body>

  <div class="d-flex">
    <a href="sair.php" class="btn btn-danger" style="position: absolute; top: 15px; right: 15px;">Sair</a>
  </div>

  <br>

  <h3 class="text-center mt-5">Formulário - Cidadania e Segurança</h3>

  <form action="form.php" method="post" id="myForm" onsubmit="return validarFormulario()">
    <div class="container">
      <div class="col-md-6 mx-auto">
        <h5 class="text-center mt-5 mb-3">Identificação</h5>

        <div class="mb-3"> <!-- Nome Completo -->
          <label for="nomeCompleto" class="form-label">Nome Completo:</label>
          <input type="text" id="nome" name="nome" class="form-control shadow-sm bg-body-tertiary" required />
        </div>
        <div class="mb-3"><!-- Dt Nascimento -->
          <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
          <input type="text" id="dataNascimento" name="dataNascimento" class="form-control shadow-sm bg-body-tertiary" placeholder="DD/MM/YYYY" required pattern="\d{2}/\d{2}/\d{4}" />
          <small class="form-text text-muted">Formato: DD/MM/YYYY</small>
        </div>
        <!-- <div class="mb-3">
          <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
          <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required/>
        </div> -->
        <div class="mb-3"><!-- Dt Nascimento -->
          <label for="cpf" class="form-label">CPF:</label>
          <input type="text" id="cpf" name="cpf" class="form-control shadow-sm bg-body-tertiary" placeholder="000.000.000-00" required />
        </div>
        <div class="mb-3"> <!-- Dt Nascimento -->
          <label for="numNIS" class="form-label">Número do NIS:</label>
          <input type="text" id="numNIS" name="numNIS" class="form-control shadow-sm bg-body-tertiary" placeholder="Digite somente números" />
        </div>
        <div class="mb-3"> <!-- GÊNERO -->
          <label for="genero" class="form-label">Gênero:</label>
          <select name="genero" id="genero" class="form-select shadow-sm bg-body-tertiary" required>
            <option value="">Selecione uma opção</option>
            <option value="Feminino">Mulher Cisgênero</option>
            <option value="Masculino">Homem Cisgênero</option>
            <option value="Não Responder">Transexual</option>
            <option value="Outro">Outro</option>
          </select>
        </div>
        <div class="mb-3"> <!-- Estado Civil -->
          <label class="form-label">Estado Civil:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="estadoCivil" id="solteiro" value="solteiro" class="form-check-input" required /><label for="solteiro" class="form-check-label">Solteiro</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="estadoCivil" id="casado" value="casado" class="form-check-input" /><label for="casado">Casado</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="estadoCivil" id="divorciado" value="divorciado" class="form-check-input" /><label for="divorciado">Divorciado</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="estadoCivil" id="uniaoEstavel" value="uniaoEstavel" class="form-check-input" /><label for="uniaoEstavel">União Estável</label>
          </div>
          <div class="">
            <label for="outro" class="form-label">Outro: </label> <input type="text" name="outroEstadoCivil" id="outro" class="form-control shadow-sm bg-body-tertiary" />
          </div>
        </div>
        <div class="mb-3"> <!-- Cor/Raça -->
          <label class="form-label">Cor/Raça:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="cor" id="branca" value="branca" class="form-check-input" required /><label for="branca">Branca</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="cor" id="preta" value="preta" class="form-check-input" /><label for="preta">Preta</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="parda" value="parda" class="form-check-input" /><label for="parda">Parda</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="indigena" value="indigena" class="form-check-input" /><label for="indigena">Indígena</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="cor" id="naoDeclarado" value="naoDeclarado" class="form-check-input" /><label for="naoDeclarado">Não Declarado</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="outra" value="outra" class="form-check-input" /><label for="outra">Outra</label>
          </div>
        </div>
        <div class="mb-3"> <!-- Nacionalidade -->
          <label for="nacionalidade" class="form-label">Nacionalidade:</label>
          <input type="text" id="nacionalidade" name="nacionalidade" class="form-control shadow-sm bg-body-tertiary" required />
        </div>
        <div class="mb-3"> <!-- Naturalidade -->
          <label for="naturalidade" class="form-label">Naturalidade:</label>
          <input type="text" id="naturalidade" name="naturalidade" class="form-control shadow-sm bg-body-tertiary" required />
        </div>
        <div class="mb-3"> <!-- Escolaridade -->
          <label for="escolaridade" class="form-label">Escolaridade</label>
          <select name="escolaridadepessoa" id="escolaridadepessoa" class="form-select shadow-sm bg-body-tertiary" required>
            <option value="">Selecione uma opção</option>
            <option value="Analfabeto">Analfabeto</option>
            <option value="Fundamental Incompleto">Fundamental Incompleto</option>
            <option value="Fundamental Completo">Fundamental Completo</option>
            <option value="Médio Incompleto">Médio Incompleto</option>
            <option value="Médio Completo">Médio Completo</option>
            <option value="Superior Incompleto">Superior Incompleto</option>
            <option value="Superior Completo">Superior Completo</option>
            <option value="Pós Graduação">Pós Graduação</option>
          </select>
        </div>
        <div class="mb-3"> <!-- Profissão -->
          <label for="profissao" class="form-label">Profissão</label>
          <input type="text" id="profissao" name="profissao" class="form-control shadow-sm bg-body-tertiary" />
        </div>
        <div class="mb-3"> <!-- Renda -->
          <label for="renda" class="form-label">Renda</label>
          <input type="text" id="renda" name="renda" class="form-control shadow-sm bg-body-tertiary" placeholder="000.000.000.000,00" />
        </div>
        <div class="mb-3"> <!-- Ocupação Profissional -->
          <label class="form-label">Ocupação Profissional:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="clt" value="clt" class="form-check-input" required /><label for="clt">CLT</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="contrato" value="contrato" class="form-check-input" /><label for="contrato">Contrato</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="autonomo" value="autonomo" class="form-check-input" /><label for="autonomo">Autônomo</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="desempregado" value="desempregado" class="form-check-input" /><label for="desempregado">Desempregado</label>
          </div>
          <div>
            <label for="outraOcupacao" class="form-label">Outra:</label>
            <input type="text" id="outraOcupacao" name="outraOcupacao" class="form-control shadow-sm bg-body-tertiary" />
          </div>
        </div>
      </div>

      <div class="mb-3 mt-3">
        <!-- Endereço/Contato -->
        <h5 class="sub-title text-center">Endereço/Contato</h5>

        <div class="col-md-6 mx-auto">
          <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control shadow-sm bg-body-tertiary" id="cep" name="cep" placeholder="00000-000">
          </div>
          <div class="row">
            <div class="col">
              <label for="rua" class="form-label">Rua/Avenida</label>
              <input type="text" class="form-control shadow-sm bg-body-tertiary" style="width: 25rem;" id="rua" name="rua" required>
            </div>
            <div class="col">
              <label for="numero" class="form-label">Número:</label>
              <input type="text" class="form-control shadow-sm bg-body-tertiary" id="numero" name="numero" required>
            </div>
          </div>
          <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control shadow-sm bg-body-tertiary" id="bairro" name="bairro" required>
          </div>
          <div class="mb-3">
            <label for="referencia" class="form-label">Ponto de Referência</label>
            <input type="text" class="form-control shadow-sm bg-body-tertiary" id="referencia" name="referencia">
          </div>
          <div class="mb-3">
            <label for="telefone" class="form-label">Telefone para contato</label>
            <input type="text" class="form-control shadow-sm bg-body-tertiary" id="telefone" name="telefone" placeholder="(DD) 00000-0000" required>
          </div>
          <div class="mb-3">
            <label for="whatsapp">Aceita ser inserido em grupo de oferta de serviços no WhatsApp?</label>
            <div class="form-check form-check-inline">
              <input type="radio" name="aceitaWhatsapp" id="sim" value="Sim" class="form-check-input" required />
              <label for="sim">Sim</label>
            </div>
            <div class="form-check form-check-inline">
              <input type="radio" name="aceitaWhatsapp" id="nao" value="Não" class="form-check-input" />
              <label for="nao">Não</label>
            </div>
          </div>
        </div>
      </div>

      <!--        Condições de Moradia            -->
      <div class="col-md-6 mx-auto mb-3">
        <h5 class="text-center mb-3 mt-5">Condições de Moradia</h5>

        <div class="mb-3">
          <label for="" class="form-label">Tipo de Residência:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoResidencia" id="propria" value="Própria" class="form-check-input" required /> <label for="propria" class="form-check-label">Própria</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoResidencia" id="alugada" value="Alugada" class="form-check-input" /> <label for="alugada">Alugada</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoResidencia" id="cedida" value="Cedida" class="form-check-input" /> <label for="cedida">Cedida</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoResidencia" id="ocupada" value="Ocupada" class="form-check-input" /> <label for="ocupada" class="form-check-label">Ocupada</label>
          </div>
        </div>
        <div class="mb-3"><!--Tipo de Estrutura-->
          <label for="" class="form-label">Tipo de Estrutura:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoEstrutura" id="alvenaria" value="Alvenaria" class="form-check-input" required />
            <label for="alvenaria">Alvenaria</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoEstrutura" id="madeira" value="Madeira" class="form-check-input" />
            <label for="madeira">Madeira</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="tipoEstrutura" id="mista" value="Mista" class="form-check-input" />
            <label for="mista">Mista</label>
          </div>
          <br>
          <div class="mt-2"><!--Outros Materiais-->
            <label for="outrosMateriais">Outros Materiais:</label>
            <input type="text" id="outrosMateriais" name="outrosMateriais" class="form-control shadow-sm bg-body-tertiary" />
          </div>
        </div>
        <div class="mb-3"><!--Energia Elétrica-->
          <label for="" class="form-label">Energia Elétrica:</label>
          <br>
          <div class="form-check">
            <input type="radio" name="energiaEletrica" id="comMedidorProprio" value="Com Medidor Próprio" class="form-check-input" required />
            <label for="comMedidorProprio">Sim, com medidor próprio</label>
          </div>
          <div class="form-check">
            <input type="radio" name="energiaEletrica" id="comMedidorCompartilhado" value="Com Medidor Compartilhado" class="form-check-input" />
            <label for="comMedidorCompartilhado">Sim, com medidor compartilhado</label>
          </div>
          <div class="form-check">
            <input type="radio" name="energiaEletrica" id="semMedidor" value="Sem Medidor" class="form-check-input" />
            <label for="semMedidor">Sim, sem medidor</label>
          </div>
          <div class="form-check">
            <input type="radio" name="energiaEletrica" id="semEnergiaEletrica" value="Sem Energia Elétrica" class="form-check-input" />
            <label for="semEnergiaEletrica">Não possui energia elétrica</label>
          </div>
        </div>
        <div class="mb-3"><!--Abastecimento de Água-->
          <label for="" class="form-label">Abastecimento de Água:</label>
          <div class="form-check">
            <input type="radio" name="abastecimentoAgua" id="redeGeralDistribuicao" value="Rede geral de distribuição" class="form-check-input" required />
            <label for="redeGeralDistribuicao">Rede geral de distribuição</label>
          </div>
          <div class="form-check">
            <input type="radio" name="abastecimentoAgua" id="pocoArtesiano" value="Poço artesiano" class="form-check-input" />
            <label for="pocoArtesiano">Poço artesiano</label>
          </div>
          <div class="form-check">
            <input type="radio" name="abastecimentoAgua" id="semAguaEncanada" value="Sem Água Encanada" class="form-check-input" />
            <label for="semAguaEncanada">Não possui água encanada</label>
          </div>
          <div class="mt-2">
            <label for="outraFormaAgua">Outra forma:</label>
            <input type="text" id="outraFormaAgua" name="outraFormaAgua" class="form-control shadow-sm bg-body-tertiary" />
          </div>
        </div>
        <div class="mb-3"><!--Escoamento Sanitário-->
          <label for="" class="form-label">Escoamento Sanitário:</label>
          <div>
            <input type="radio" name="escoamentoSanitario" id="redeGeralDistribuicaoSanitario" value="Rede Geral de Tratamento de Esgoto" class="form-check-input" required />
            <label for="redeGeralDistribuicaoSanitario">Rede Geral de Tratamento de Esgoto</label>
          </div>
          <div>
            <input type="radio" name="escoamentoSanitario" id="pocoArtesianoSanitario" value="Esgoto Sanitário" class="form-check-input" />
            <label for="pocoArtesianoSanitario">Esgoto Sanitário</label>
          </div>
          <div>
            <input type="radio" name="escoamentoSanitario" id="semEsgoto" value="Não Possui Esgoto" class="form-check-input" />
            <label for="semEsgoto">Não possui esgoto</label>
          </div>
          <div class="mt-2">
            <label for="outraFormaEsgoto">Outra forma:</label>
            <input type="text" id="outraFormaEsgoto" name="outraFormaEsgoto" class="form-control shadow-sm bg-body-tertiary" />
          </div>
        </div>

        <!--               Benefícios Sociais               -->
        <h5 class="text-center">Benefícios Sociais</h5>
        <div class="form-check">
          <input type="radio" name="beneficiosSociais" id="naoBeneficiosSociais" value="Não" class="form-check-input" required />
          <label for="naoBeneficiosSociais">Não</label>
        </div>
        <div>
          <input type="radio" name="beneficiosSociais" id="bolsaFamilia" value="Bolsa Família" class="form-check-input" />
          <label for="bolsaFamilia">Bolsa Família</label>
        </div>
        <div>
          <input type="radio" name="beneficiosSociais" id="auxilioEstadual" value="Auxílio Estadual" class="form-check-input" />
          <label for="auxilioEstadual">Auxílio Estadual</label>
        </div>
        <div>
          <input type="radio" name="beneficiosSociais" id="bpc" value="Benefício de Prestação Continuada (BPC)" class="form-check-input" />
          <label for="bpc">Benefício de Prestação Continuada (BPC)</label>
        </div>
        <div class="mt-2">
          <label for="outroBeneficio">Outro:</label>
          <input type="text" id="outroBeneficio" name="outroBeneficio" class="form-control shadow-sm bg-body-tertiary" />
        </div>
        <div class="mb-3 mt-3">
          <label for="" class="form-label"> Situação do Cadastro Único:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="naoPossuiCadastroUnico" value="Não Possui CAD Único" class="form-check-input" required />
            <label for="naoPossuiCadastroUnico">Não Possui</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="atualizadoCadastroUnico" value="Atualizado" class="form-check-input" />
            <label for="atualizadoCadastroUnico">Atualizado</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="desatualizadoCadastroUnico" value="Desatualizado" class="form-check-input" />
            <label for="desatualizadoCadastroUnico">Desatualizado</label>
          </div>
        </div>
      </div>
      <!--        Necessidades de Documentação Civil           -->
      <div class="col-md-6 mx-auto mb-3">
        <h5 class="text-center mb-3 mt-3">Necessidades de Documentação Civil</h5>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="semNecessidade" value="Sem Necessidade" class="form-check-input" />
          <label for="cni">SEM NECESSIDADE</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="cni" value="CNI/RG" class="form-check-input" />
          <label for="cni">CNI/RG</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="cpf" value="CPF" class="form-check-input" />
          <label for="cpf">CPF</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="rcn" value="RCN" class="form-check-input" />
          <label for="rcn">RCN</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="cpcd" value="Carteira PCD" class="form-check-input" />
          <label for="cpcd">CARTEIRA PCD</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="cptea" value="Carteira CPTEA" class="form-check-input" />
          <label for="cptea">CARTEIRA CIPTEA</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="rnm" value="Registro Nacional dos Migrantes" class="form-check-input" />
          <label for="rnm">REGISTRO NACIONAL DOS MIGRANTES (RNM)</label>
        </div>
        <div class="form-check">
          <input type="checkbox" name="documentacaocivil[]" id="carteiraIdoso" value="Carteira do Idoso" class="form-check-input" />
          <label for="carteiraIdoso">CARTEIRA DO IDOSO</label>
        </div>
      </div>

      <!--            SOCIOECONOMICO                -->
      <div class="col-md-6 mx-auto mb-3" id="dynamic-content">
        <h5 class="text-center">Socioêconomico</h5>
        <div class="mb-2">
          <label for="nomeCompletoSocio" class="form-label">Nome Completo do Familiar:</label>
          <input type="text" id="nomesocio1" name="nomesocio[]" class="form-control shadow-sm bg-body-tertiary" />
        </div>
        <div class="mb-2">
          <label for="nomeCompletoSocio" class="form-label">Idade do Familiar:</label>
          <input type="text" id="idadesocio1" name="idadesocio[]" class="form-control shadow-sm bg-body-tertiary" placeholder="Digite apenas números" />
        </div>
        <div class="mb-2">
          <label for="" class="form-label">Vinculo Familiar:</label>
          <select id="relacao1" name="relacao[]" class="form-select shadow-sm bg-body-tertiary">
            <option value="" selected disabled>Selecione uma opção</option>
            <option value="Pessoa de referência">Pessoa de referência</option>
            <option value="Cônjugue/Companheiro(a)">Cônjugue/Companheiro(a)</option>
            <option value="Filho(a)">Filho(a)</option>
            <option value="Enteado(a)">Enteado(a)</option>
            <option value="Neto(a), Bisneto(a)">Neto(a), Bisneto(a)</option>
            <option value="Pai/Mãe">Pai/Mãe</option>
            <option value="Sogro(a)">Sogro(a)</option>
            <option value="Irmão/Irmã">Irmão/Irmã</option>
            <option value="Genro/Nora">Genro/Nora</option>
            <option value="Outro Parente">Outro Parente</option>
            <option value="Não Parente">Não Parente</option>
          </select>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">Escolaridade:</label>
          <select id="escolaridadeFam1" name="escolaridadeFam[]" class="form-select shadow-sm bg-body-tertiary">
            <option value="" selected disabled>Selecione uma opção</option>
            <option value="Não Alfabetizado">Não Alfabetizado</option>
            <option value="Ens. Fundamental Completo">Ens. Fundamental Completo</option>
            <option value="Ens. Fundamental Incompleto">Ens. Fundamental Incompleto</option>
            <option value="Ens. Médio Completo">Ens. Médio Completo</option>
            <option value="Ens. Médio Incompleto">Ens. Médio Incompleto</option>
            <option value="Ens. Superior Completo">Ens. Superior Completo</option>
            <option value="Ens. Superior Incompleto">Ens. Superior Incompleto</option>
          </select>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">Tipo de PCD:</label>
          <select id="deficiencia1" name="deficiencia[]" class="form-select shadow-sm bg-body-tertiary">
            <option value="" selected disabled>Selecione uma opção</option>
            <option value="Sem Deficiência">Sem Deficiência</option>
            <option value="Visual">Visual</option>
            <option value="Auditiva">Auditiva</option>
            <option value="Mental">Mental</option>
            <option value="Física">Física</option>
            <option value="Múltipla">Múltipla</option>
          </select>
        </div>
        <div class="mb-2">
          <label for="" class="form-label">Necessidade de Documentação:</label>
          <select id="documentacao1" name="documentacao[]" class="form-select shadow-sm bg-body-tertiary">
            <option value="" selected disabled>Selecione uma opção</option>
            <option value="Sem Necessidade">SEM NECESSIDADE</option>
            <option value="CIN/RG">CIN/RG</option>
            <option value="CPF">CPF</option>
            <option value="Carteira PCD">CARTEIRA PCD</option>
            <option value="RCN">RCN</option>
            <option value="Carteira CIPTEA">CARTEIRA CIPTEA</option>
            <option value="Carteira IDOSO">CARTEIRA IDOSO</option>
            <option value="RNM">RNM</option>
            <option value="Outra">OUTRA</option>
          </select>
        </div>

        <br>
      </div>

      <!-- BTN Adicionar Cadastro -->

      <div class="d-grid gap-2 col-6 mx-auto mb-5">
        <button class="btn btn-success mx-auto" type="button" onclick="adicionarLinha()"><i class="bi bi-plus-circle"></i> Adicionar Novo Cadastro</button>
      </div>






      <script>
        let contador = 1;

        function adicionarLinha() {

          contador++;

          const dynamicContent = document.querySelector("#dynamic-content");
          const newRow = document.createElement("div");
          newRow.classList.add("mb-3");
          newRow.innerHTML = `
      <h5>Socioêconomico</h5>
      <div class="mb-2">
      <label for="nomeCompletoSocio" class="form-label">Nome Completo do Familiar:</label>
      <input type="text" id="nomesocio${contador}" name="nomesocio[]" class="form-control shadow-sm bg-body-tertiary"/>
      </div>
      <div class="mb-2">
        <label for="idadeSocio" class="form-label">Idade do Familiar:</label>
        <input type="text" id="idadesocio${contador}" name="idadesocio[]" class="form-control shadow-sm bg-body-tertiary" placeholder="Digite apenas números"/>
        </div>
        <div class="mb-2">
        <label for="relacao" class="form-label">Vínculo Familiar:</label>
        <select id="relacao${contador}" name="relacao[]" class="form-select shadow-sm bg-body-tertiary">
        <option value="" selected disabled>Selecione uma opção</option>
        <option value="Pessoa de referência">Pessoa de referência</option>
        <option value="Cônjugue/Companheiro(a)">Cônjugue/Companheiro(a)</option>
        <option value="Filho(a)">Filho(a)</option>
        <option value="Enteado(a)">Enteado(a)</option>
        <option value="Neto(a), Bisneto(a)">Neto(a), Bisneto(a)</option>
        <option value="Pai/Mãe">Pai/Mãe</option>
        <option value="Sogro(a)">Sogro(a)</option>
        <option value="Irmão/Irmã">Irmão/Irmã</option>
        <option value="Genro/Nora">Genro/Nora</option>
        <option value="Outro Parente">Outro Parente</option>
        <option value="Não Parente">Não Parente</option>
      </select>
      </div>
      
      <div class="mb-2">
      <label for="escolaridade" class="form-label">Escolaridade:</label>
      <select id="escolaridadeFam${contador}" name="escolaridadeFam[]" class="form-select shadow-sm bg-body-tertiary">
        <option value="" selected disabled>Selecione uma opção</option>
        <option value="Não Alfabetizado">Não Alfabetizado</option>
        <option value="Ens. Fundamental Completo">Ens. Fundamental Completo</option>
        <option value="Ens. Fundamental Incompleto">Ens. Fundamental Incompleto</option>
        <option value="Ens. Médio Completo">Ens. Médio Completo</option>
        <option value="Ens. Médio Incompleto">Ens. Médio Incompleto</option>
        <option value="Ens. Superior Completo">Ens. Superior Completo</option>
        <option value="Ens. Superior Incompleto">Ens. Superior Incompleto</option>
      </select>
      </div>
      <div class="mb-2">
      <label for="deficiencia" class="form-label">Tipo de PCD:</label>
      <select id="deficiencia${contador}" name="deficiencia[]" class="form-select shadow-sm bg-body-tertiary">
        <option value="" selected disabled>Selecione uma opção</option>
        <option value="Sem Deficiência">Sem Deficiência</option>
        <option value="Visual">Visual</option>
        <option value="Auditiva">Auditiva</option>
        <option value="Mental">Mental</option>
        <option value="Física">Física</option>
        <option value="Múltipla">Múltipla</option>
      </select>
      </div>
      <div class="mb-2">
      <label for="documentacao" class="form-label">Necessidade de Documentação:</label>
      <select id="documentacao${contador}" name="documentacao[]" class="form-select shadow-sm bg-body-tertiary">
        <option value="" selected disabled>Selecione uma opção</option>
        <option value="Sem Necessidade">SEM NECESSIDADE</option>
        <option value="CIN/RG">CIN/RG</option>
        <option value="CPF">CPF</option>
        <option value="Carteira PCD">CARTEIRA PCD</option>
        <option value="RCN">RCN</option>
        <option value="Carteira CIPTEA">CARTEIRA CIPTEA</option>
        <option value="Carteira IDOSO">CARTEIRA IDOSO</option>
        <option value="RNM">RNM</option>
        <option value="Outra">OUTRA</option>
      </select>
      </div>
      <br>
      <button type="button" onclick="removerLinha(this)" class="btn btn-danger"><i class="bi bi-x-circle"></i> Remover Cadastro</button>

      
    `;
          dynamicContent.appendChild(newRow);
        }

        function removerLinha(button) {
          const rowToRemove = button.parentNode;
          rowToRemove.parentNode.removeChild(rowToRemove);
        }
      </script>


    </div>
    <form>
      <!--        Encaminhamentos/Agendamentos            -->
      <div class="container">
        <div class="col-md-6 mx-auto mb-3">
          <h5 class="text-center">Encaminhamentos/Agendamentos</h5>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="semNecessidade" value="Sem Necessidade" class="form-check-input" />
            <label for="cni">SEM NECESSIDADE DE ENCAMINHAMENTO</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento1" value="SEJUSC Cidadania (CPF,RCN)" class="form-check-input" />
            <label for="encaminhamento1">SEJUSC CIDADANIA (CPF,RCN)</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento2" value="SEJUSC PCD" class="form-check-input" />
            <label for="encaminhamento2">SEJUSC PCD</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento3" value="Inserção/Atualização CADÚNICO-SEMASC" class="form-check-input" />
            <label for="encaminhamento3">INSERÇÃO/ATUALIZAÇÃO CADÚNICO-SEMASC</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento4" value="Curso de Defesa Pessoal Para Mulheres - SEDEL" class="form-check-input" />
            <label for="encaminhamento4">CURSO DE DEFESA PESSOAL PARA MULHERES - SEDEL</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento5" value="Escritório Social - SEAP" class="form-check-input" />
            <label for="encaminhamento5">ESCRITÓRIO SOCIAL - SEAP</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento6" value="Curso de Capacitação Profissional" class="form-check-input" />
            <label for="encaminhamento6">CURSO DE CAPACITAÇÃO PROFISSIONAL</label>
          </div>

          <div class="mb-3">
            <label for="nomeCompletoTec" class="form-label">Nome completo do Técnico:</label>
            <input type="text" id="nomeCompletoTec" name="nomeCompletoTec" class="form-control shadow-sm bg-body-tertiary" required />
          </div>

        </div>
      </div>

      <div class="d-grid gap-2 col-4 mx-auto mb-5 mt-5">
        <button type="submit" name="submit" id="submit" class="btn btn-primary">Enviar</button>
      </div>


      <!-- Bibliteca de máscaras -->
      <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
      <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

      <!-- Mascara do CPF e NIS -->
      <script>
        $(document).ready(function() {
          // Máscara para CPF
          $('#cpf').mask('000.000.000-00', {
            reverse: true
          });

          // Máscara para NIS
          $('#numNIS').mask('00000000000');

          // Máscara para a Renda
          $('#renda').mask('000.000.000.000,00', {
            reverse: true
          });

          // Máscara para o CEP
          $('#cep').mask('00000-000');

          // Máscara para o Telefone
          $('#telefone').mask('(00) 00000-0009');

          // Máscara para Idade Familiar
          $('#idadesocio1').mask('000');

          // Máscara para a Data
          $('#dataNascimento').mask('00/00/0000');




        });
      </script>


    </form>

    <script>
      function validarFormulario() {
        var checkboxesEncaminhamentos = document.querySelectorAll('input[name="encaminhamentosAgendados[]"]');
        var isCheckedEncaminhamentos = false;

        for (var i = 0; i < checkboxesEncaminhamentos.length; i++) {
          if (checkboxesEncaminhamentos[i].checked) {
            isCheckedEncaminhamentos = true;
            break;
          }
        }

        var checkboxesDocumentacaoCivil = document.querySelectorAll('input[name="documentacaocivil[]"]');
        var isCheckedDocumentacaoCivil = false;

        for (var i = 0; i < checkboxesDocumentacaoCivil.length; i++) {
          if (checkboxesDocumentacaoCivil[i].checked) {
            isCheckedDocumentacaoCivil = true;
            break;
          }
        }

        if (!isCheckedEncaminhamentos) {
          alert("Selecione pelo menos um encaminhamento/agendamento.");
          return false; // Impede o envio do formulário
        }

        if (!isCheckedDocumentacaoCivil) {
          alert("Selecione pelo menos uma necessidade de documentação civil.");
          return false; // Impede o envio do formulário
        }

        return true; // Permite o envio do formulário
      }
    </script>

</body>

</html>