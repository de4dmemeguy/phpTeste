
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

  // Inclua o arquivo de configuração do banco de dados
  include_once('config.php');

  //Definir o fuso horário para o de Manaus
  date_default_timezone_set('America/Manaus');

  $idpessoa = null;

  if (isset($_GET['idpessoa']) || isset($_POST['idpessoa'])) {

    $idpessoa = $_GET['idpessoa'] ?? $_POST['idpessoa'];

    $resultado_pessoa = mysqli_query($conexao, "SELECT * FROM pessoa WHERE IDPESSOA = $idpessoa");

    $pessoa = $resultado_pessoa->fetch_assoc();

    // var_dump($pessoa);
  }

  if(isset($_POST['submit']))
  {
    var_dump($_POST);
     for ($i = 0; $i < count($_POST['nomesocio']); $i++) {
       if ($i == 0 || $_POST['nomesocio'][$i]) {
        // echo "<br><br>Vai inserir o socio: " . ($i + 1) . "<br><br>";
        // Prepare a query SQL para atualização de dados
        $sql = "UPDATE pessoa SET 
        nome = ?,
        data_nasc = ?,
        cpf = ?,
        numero_nis = ?,
        genero = ?,
        estado_civil = ?,
        outro_estado_civil = ?,
        cor_raca = ?,
        nacionalidade = ?,
        naturalidade = ?,
        escolaridade = ?,
        profissao = ?,
        renda = ?,
        ocupacao_profissional = ?,
        outra_ocupacao = ?,
        end_cep = ?,
        end_rua = ?,
        end_num = ?,
        end_bairro = ?,
        end_p_referencia = ?,
        telefone = ?,
        oferta_whatsapp = ?,
        tipo_residencia = ?,
        estrutura_residencia = ?,
        outros_materiais = ?,
        energia_eletrica = ?,
        abast_agua = ?,
        outra_forma_agua = ?,
        escoa_sanitario = ?,
        outra_forma_esgoto = ?,
        beneficios_sociais = ?,
        outros_beneficios = ?,
        sit_cad_unico = ?,
        docum_civil = ?,
        nome_familiar = ?,
        idade_familiar = ?,
        vinculo_familiar = ?,
        escolaridade_familiar = ?,
        tipo_pcd = ?,
        neces_doc_familiar = ?,
        encaminhamentos = ?,
        tecnico_responsavel = ?,
        data_hora_cadastro = ? 
        WHERE IDPESSOA = ?";

// nome_familiar = ?,
// idade_familiar = ?,
// vinculo_familiar = ?,
// escolaridade_familiar = ?,
// tipo_pcd = ?,
// neces_doc_familiar = ?,

        // Preparar a instrução SQL
        $stmt = $conexao->prepare($sql);

        // Obtém a data e hora atual
        $data_hora_cadastro = $pessoa['data_hora_cadastro'] ?? date('Y-m-d H:i:s');
        $documentacao_civil = implode(',', $_POST['documentacaocivil']);
        $encaminhamentos = implode(',', $_POST['encaminhamentosAgendados']);

        // Liga os parâmetros da instrução SQL aos valores dos campos do formulário
        $stmt->bind_param(
          "ssssssssssssssssssssssssssssssssssssssssssss",
          $_POST['nome'],
          $_POST['dataNascimento'],
          $_POST['cpf'],
          $_POST['numNIS'],
          $_POST['genero'],
          $_POST['estadoCivil'],
          $_POST['outroEstadoCivil'],
          $_POST['cor'],
          $_POST['nacionalidade'],
          $_POST['naturalidade'],
          $_POST['escolaridadepessoa'],
          $_POST['profissao'],
          $_POST['renda'],
          $_POST['ocupacao'],
          $_POST['outraOcupacao'],
          $_POST['cep'],
          $_POST['rua'],
          $_POST['numero'],
          $_POST['bairro'],
          $_POST['referencia'],
          $_POST['telefone'],
          $_POST['aceitaWhatsapp'],
          $_POST['tipoResidencia'],
          $_POST['tipoEstrutura'],
          $_POST['outrosMateriais'],
          $_POST['energiaEletrica'],
          $_POST['abastecimentoAgua'],
          $_POST['outraFormaAgua'],
          $_POST['escoamentoSanitario'],
          $_POST['outraFormaEsgoto'],
          $_POST['beneficiosSociais'],
          $_POST['outroBeneficio'],
          $_POST['situacaoCadastroUnico'],
          $documentacao_civil,
          $_POST['nomesocio'][$i],
          $_POST['idadesocio'][$i],
          $_POST['relacao'][$i],
          $_POST['escolaridadeFam'][$i],
          $_POST['deficiencia'][$i],
          $_POST['documentacao'][$i],
          $encaminhamentos,
          $_POST['nomeCompletoTec'],
          $data_hora_cadastro,
          $_POST['idpessoa']
        );

        // $_POST['nomesocio'][$i],
          // $_POST['idadesocio'][$i],
          // $_POST['relacao'][$i],
          // $_POST['escolaridadeFam'][$i],
          // $_POST['deficiencia'][$i],
          // $_POST['documentacao'][$i],
          // $documentacao_civil,
          // $documentacao_civil,
          // $documentacao_civil,
          // $documentacao_civil,
          // $documentacao_civil,
          // $documentacao_civil,

        $stmt->execute();
        // $stmt->close();

        var_dump('Passou aqui');
       }
     }

    
      exit;      
  }
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
    integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="shortcut icon" href="/CidadaniaEseguranca/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon">
  <link rel="import" href="cadastro.html">

  <link rel="stylesheet" href="/CidadaniaEseguranca/src/css/styles.css" />
  <script src="./services/form.js" defer></script>
  <title>Cidadania e Segurança</title>

</head>

<body>
<br>
<div class="d-flex">
      <a href="sair.php" class="btn btn-danger" style="position: absolute; top: 20px; right: 20px;">Sair</a>
  </div>
  <br>
  <div class="title">
    <h3>Formulário - Cidadania e Segurança</h3>
  </div>
  
  <br>
  <form action="form_edit.php" method="post" id="myForm" onsubmit="return validarFormulario()">
    <div class="container">
      <div>
        <br>
        <h5 class="sub-title">Identificação</h5>
        <div>
          <input type="hidden" name="idpessoa" value="<?php echo $pessoa['IDPESSOA']; ?>">
        </div>
        <div class="mb-3">
          <label for="nomeCompleto" class="form-label">Nome Completo:</label>
          <input type="text" id="nome" name="nome" class="form-control" value="<?php echo $pessoa['NOME']; ?>" required/>
        </div>
        <div class="mb-3">
            <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
            <input type="text" id="dataNascimento" name="dataNascimento" class="form-control" value="<?php echo $pessoa['DATA_NASC']; ?>" required/>
            <small class="form-text text-muted">Formato: DD/MM/YYYY</small>
        </div>

        <!-- <div class="mb-3">
          <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
          <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" required/>
        </div> -->
        <div class="mb-3">
          <label for="cpf" class="form-label">CPF:</label>
          <input type="text" id="cpf" name="cpf" class="form-control " value="<?php echo $pessoa['CPF']; ?>" required/>
        </div>
        <div class="mb-3">
          <label for="numNIS" class="form-label">NÚMERO DO NIS:</label>
          <input type="text" id="numNIS" name="numNIS" class="form-control" value="<?php echo $pessoa['NUMERO_NIS']; ?>" />
        </div>
        <div class="mb-3">
          <label for="genero" class="form-label">Gênero:</label>
          <select name="genero" id="genero" class="form-select" required>
            <option value="">Selecione uma opção</option>
            <option value="Feminino" <?php echo ($pessoa['GENERO'] == 'feminino' ? 'selected' : '') ?>>Mulher Cisgênero</option>
            <option value="Masculino" <?php echo ($pessoa['GENERO'] == 'masculino' ? 'selected' : '') ?>>Homem Cisgênero</option>
            <option value="Não Responder" <?php echo ($pessoa['GENERO'] == 'nao responder' ? 'selected' : '') ?>>Transexual</option>
            <option value="Outro" <?php echo ($pessoa['GENERO'] == 'outro' ? 'selected' : '') ?>>Outro</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Estado Civil:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="estadoCivil" id="solteiro" value="solteiro" class="form-check-input" <?php echo ($pessoa['ESTADO_CIVIL'] == 'solteiro' ? 'checked' : '') ?>/><label
              for="solteiro" class="form-check-label">Solteiro</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="estadoCivil" id="casado" value="casado" class="form-check-input" <?php echo ($pessoa['ESTADO_CIVIL'] == 'casado' ? 'checked' : '') ?>/><label
              for="casado">Casado</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="estadoCivil" id="divorciado" value="divorciado" class="form-check-input" <?php echo ($pessoa['ESTADO_CIVIL'] == 'divorciado' ? 'checked' : '') ?> /><label
              for="divorciado">Divorciado</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="estadoCivil" id="uniaoEstavel" value="uniaoEstavel"
              class="form-check-input" <?php echo ($pessoa['ESTADO_CIVIL'] == 'uniaoEstavel' ? 'checked' : '') ?> /><label for="uniaoEstavel">União Estável</label>
          </div>
          <div class="">
            <label for="outro" class="form-label">Outro: </label> <input type="text" name="outroEstadoCivil" id="outro"
              class="form-control" value="<?php echo $pessoa['OUTRO_ESTADO_CIVIL']; ?>" />
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Cor/Raça:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="cor" id="branca" value="branca" class="form-check-input" <?php echo ($pessoa['COR_RACA'] == 'branca') ? 'checked' : '' ?> required/><label
              for="branca">Branca</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="cor" id="preta" value="preta" class="form-check-input" <?php echo ($pessoa['COR_RACA'] == 'preta') ? 'checked' : '' ?> /><label
              for="preta">Preta</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="parda" value="parda" class="form-check-input" <?php echo ($pessoa['COR_RACA'] == 'parda') ? 'checked' : '' ?> /><label
              for="parda">Parda</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="indigena" value="indigena" class="form-check-input" <?php echo ($pessoa['COR_RACA'] == 'indigena') ? 'checked' : '' ?> /><label
              for="indigena">Indígena</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="cor" id="naoDeclarado" value="naoDeclarado" class="form-check-input" <?php echo ($pessoa['COR_RACA'] == 'naoDeclarado') ? 'checked' : '' ?> /><label
              for="naoDeclarado">Não Declarado</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="outra" value="outra" class="form-check-input" <?php echo ($pessoa['COR_RACA'] == 'outra') ? 'checked' : '' ?> /><label
              for="outra">Outra</label>
          </div>
        </div>
        <div class="mb-3">
          <label for="nacionalidade" class="form-label">Nacionalidade:</label>
          <input type="text" id="nacionalidade" name="nacionalidade" class="form-control" value="<?php echo $pessoa['NACIONALIDADE']; ?>" required/>
        </div>
        <div class="mb-3">
          <label for="naturalidade" class="form-label">Naturalidade:</label>
          <input type="text" id="naturalidade" name="naturalidade" class="form-control" value="<?php echo $pessoa['NATURALIDADE']; ?>" />
        </div>
        <div class="mb-3">
          <label for="escolaridade" class="form-label">Escolaridade</label>
          <select name="escolaridadepessoa" id="escolaridadepessoa" class="form-select" >
            <option value="">Selecione uma opção</option>
            <option value="Analfabeto" <?php echo ($pessoa['ESCOLARIDADE'] == 'analfabeto' ? 'selected' : '') ?>>Analfabeto</option>
            <option value="Fundamental Incompleto" <?php echo ($pessoa['ESCOLARIDADE'] == 'fundamentalIncompleto' ? 'selected' : '') ?>>Fundamental Incompleto</option>
            <option value="Fundamental Completo" <?php echo ($pessoa['ESCOLARIDADE'] == 'fundamentalCompleto' ? 'selected' : '') ?>>Fundamental Completo</option>
            <option value="Médio Incompleto" <?php echo ($pessoa['ESCOLARIDADE'] == 'medioIncompleto' ? 'selected' : '') ?>>Médio Incompleto</option>
            <option value="Médio Completo" <?php echo ($pessoa['ESCOLARIDADE'] == 'medioCompleto' ? 'selected' : '') ?>>Médio Completo</option>
            <option value="Superior Incompleto" <?php echo ($pessoa['ESCOLARIDADE'] == 'superiorIncompleto' ? 'selected' : '') ?>>Superior Incompleto</option>
            <option value="Superior Completo" <?php echo ($pessoa['ESCOLARIDADE'] == 'superiorCompleto' ? 'selected' : '') ?>>Superior Completo</option>
            <option value="Pós Graduação" <?php echo ($pessoa['ESCOLARIDADE'] == 'posGraduacao' ? 'selected' : '') ?>>Pós Graduação</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="profissao" class="form-label">Profissão</label>
          <input type="text" id="profissao" name="profissao" class="form-control" value="<?php echo $pessoa['OCUPACAO_PROFISSIONAL']; ?>" />
        </div>
        <div>
          <label for="renda" class="form-label">Renda</label>
          <input type="text" id="renda" name="renda" class="form-control" value="<?php echo $pessoa['RENDA']; ?>" />
        </div>
        <div class="mb-3">
          <label class="form-label">Ocupação Profissional:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="clt" value="clt" class="form-check-input" <?php echo ($pessoa['OCUPACAO_PROFISSIONAL'] == 'clt') ? 'checked' : '' ?> /><label
              for="clt">CLT</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="contrato" value="contrato" class="form-check-input" <?php echo ($pessoa['OCUPACAO_PROFISSIONAL'] == 'contratado') ? 'checked' : '' ?> /><label
              for="contrato">Contrato</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="autonomo" value="autonomo" class="form-check-input" <?php echo ($pessoa['OCUPACAO_PROFISSIONAL'] == 'autonomo') ? 'checked' : '' ?> /><label
              for="autonomo">Autônomo</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="desempregado" value="desempregado" class="form-check-input" <?php echo ($pessoa['OCUPACAO_PROFISSIONAL'] == 'desempregado') ? 'checked' : '' ?> /><label
              for="desempregado">Desempregado</label>
          </div>
          <div>
            <label for="outraOcupacao" class="form-label">Outra:</label>
            <input type="text" id="outraOcupacao" name="outraOcupacao" class="form-control" value="<?php echo $pessoa['PROFISSAO']; ?>" />
          </div>
        </div>
      </div>

      
      <div class="mb-3">
        <h5 class="sub-title">Endereço/Contato</h5>
        <div>
          <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep" value="<?php echo $pessoa['NUMERO_NIS']; ?>"  />
          </div>
          <div class="row">
            <div class="col">
              <label for="rua" class="form-label">Rua/Avenida</label>
              <input type="text" class="form-control" style="width: 25rem;" id="rua" name="rua" value="<?php echo $pessoa['END_RUA']; ?>"required>
            </div>
            <div class="col">
              <label for="numero" class="form-label">Número:</label>
              <input type="text" class="form-control" id="numero" name="numero" value="<?php echo $pessoa['END_NUM']; ?>" >
            </div>
          </div>
          <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro" value="<?php echo $pessoa['END_BAIRRO']; ?>" >
          </div>
          <div class="mb-3">
            <label for="referencia" class="form-label">Ponto de Referência</label>
            <input type="text" class="form-control" id="referencia" name="referencia" value="<?php echo $pessoa['END_P_REFERENCIA']; ?>" >
          </div>
          <div class="mb-3">
            <label for="telefone" class="form-label">Telefone para contato</label>
            <input type="text" class="form-control" id="telefone" name="telefone" value="<?php echo $pessoa['TELEFONE']; ?>" >
          </div>

          <div class="mb-3">
            <label for="whatsapp">Aceita ser inserido em grupo de oferta de serviços no WhatsApp?</label>
            <div class="form-check form-check-inline">
              <input type="radio" name="aceitaWhatsapp" id="sim" value="Sim" class="form-check-input" <?php echo ($pessoa['OFERTA_WHATSAPP'] == 'sim' ? 'checked' : '') ?> />
              <label for="sim">Sim</label>
            </div>
                   
            <div class="form-check form-check-inline">
              <input type="radio" name="aceitaWhatsapp" id="nao" value="Não" class="form-check-input" <?php echo ($pessoa['OFERTA_WHATSAPP'] == 'nao' ? 'checked' : '') ?> />
              <label for="nao">Não</label>
            </div>
          </div>


        </div>
      </div>

      <div class="mb-3">
        <h5 class="sub-title">Condições de Moradia</h5>
        <label for="" class="form-label">Tipo de Residência:</label>
        <br>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="propria" value="Própria" class="form-check-input" <?php echo ($pessoa['TIPO_RESIDENCIA'] == 'propia' ? 'checked' : '') ?> />
          <label for="propria" class="form-check-label">Própria</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="alugada" value="Alugada" class="form-check-input" <?php echo ($pessoa['TIPO_RESIDENCIA'] == 'alugada' ? 'checked' : '') ?> />
          <label for="alugada">Alugada</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="cedida" value="Cedida" class="form-check-input" <?php echo ($pessoa['TIPO_RESIDENCIA'] == 'cedida' ? 'checked' : '') ?> />
          <label for="cedida">Cedida</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="ocupada" value="Ocupada" class="form-check-input" <?php echo ($pessoa['TIPO_RESIDENCIA'] == 'ocupada' ? 'checked' : '') ?> />
          <label for="ocupada" class="form-check-label">Ocupada</label>
        </div>
        <br>
        <label for="" class="form-label">Tipo de Estrutura:</label>
        <br>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoEstrutura" id="alvenaria" value="Alvenaria" class="form-check-input" <?php echo ($pessoa['ESTRUTURA_RESIDENCIA'] == 'alvenaria' ? 'checked' : '') ?> />
          <label for="alvenaria">Alvenaria</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoEstrutura" id="madeira" value="Madeira" class="form-check-input" <?php echo ($pessoa['ESTRUTURA_RESIDENCIA'] == 'madeira' ? 'checked' : '') ?> />
          <label for="madeira">Madeira</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoEstrutura" id="mista" value="Mista" class="form-check-input" <?php echo ($pessoa['ESTRUTURA_RESIDENCIA'] == 'mista' ? 'checked' : '') ?> />
          <label for="mista">Mista</label>
        </div>
        <br>
        <div class="">
          <label for="outrosMateriais">Outros Materiais:</label>
          <input type="text" id="outrosMateriais" name="outrosMateriais" class="form-control" value="<?php echo $pessoa['OUTROS_MATERIAIS']; ?>" />
        </div>

        <label for="" class="form-label">Energia Elétrica:</label>
        <br>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="comMedidorProprio" value="Com Medidor Próprio" class="form-check-input" <?php echo ($pessoa['ENERGIA_ELETRICA'] == 'COM MEDIDOR PRÓPRIO' ? 'checked' : '') ?> />
          <label for="comMedidorProprio">Sim, com medidor próprio</label>
        </div>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="comMedidorCompartilhado" value="Com Medidor Compartilhado" class="form-check-input" <?php echo ($pessoa['ENERGIA_ELETRICA'] == 'COM MEDIDOR COMPARTILHADO' ? 'checked' : '') ?> />
          <label for="comMedidorCompartilhado">Sim, com medidor compartilhado</label>
        </div>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="semMedidor" value="Sem Medidor" class="form-check-input" <?php echo ($pessoa['ENERGIA_ELETRICA'] == 'SEM MEDIDOR' ? 'checked' : '') ?> />
          <label for="semMedidor">Sim, sem medidor</label>
        </div>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="semEnergiaEletrica" value="Sem Energia Elétrica" class="form-check-input" <?php echo ($pessoa['ENERGIA_ELETRICA'] == 'SEM ENERGIA ELÉTRICA' ? 'checked' : '') ?> />
          <label for="semEnergiaEletrica">Não possui energia elétrica</label>
        </div>
        <label for="" class="form-label">Abastecimento de Água:</label>
        <div class="form-check">
          <input type="radio" name="abastecimentoAgua" id="redeGeralDistribuicao" value="Rede geral de distribuição" class="form-check-input" <?php echo ($pessoa['ABAST_AGUA'] == 'Rede geral de distribuição' ? 'checked' : '') ?> />
          <label for="redeGeralDistribuicao">Rede geral de distribuição</label>
        </div>
        <div class="form-check">
          <input type="radio" name="abastecimentoAgua" id="pocoArtesiano" value="Poço artesiano" class="form-check-input" <?php echo ($pessoa['ABAST_AGUA'] == 'Poço artesiano' ? 'checked' : '') ?>  />
          <label for="pocoArtesiano">Poço artesiano</label>
        </div>
        <div class="form-check">
          <input type="radio" name="abastecimentoAgua" id="semAguaEncanada" value="Sem Água Encanada" class="form-check-input" <?php echo ($pessoa['ABAST_AGUA'] == 'Sem Água Encanada' ? 'checked' : '') ?>  />
          <label for="semAguaEncanada">Não possui água encanada</label>
        </div>
        <div>
          <label for="outraFormaAgua">Outra forma:</label>
          <input type="text" id="outraFormaAgua" name="outraFormaAgua" class="form-control" value="<?php echo $pessoa['OUTRA_FORMA_AGUA']; ?>" />
        </div>
        <label for="" class="form-label">Escoamento Sanitário:</label>
        <div>
          <input type="radio" name="escoamentoSanitario" id="redeGeralDistribuicaoSanitario" value="Rede Geral de Tratamento de Esgoto" class="form-check-input" <?php echo ($pessoa['ESCOA_SANITARIO'] == 'Rede Geral de Tratamento de Esgoto' ? 'checked' : '') ?> />
          <label for="redeGeralDistribuicaoSanitario">Rede Geral de Tratamento de Esgoto</label>
        </div>
        <div>
          <input type="radio" name="escoamentoSanitario" id="pocoArtesianoSanitario" value="Esgoto Sanitário" class="form-check-input" <?php echo ($pessoa['ESCOA_SANITARIO'] == 'Esgoto sanitário' ? 'checked' : '') ?> />
          <label for="pocoArtesianoSanitario">Esgoto Sanitário</label>
        </div>
        <div>
          <input type="radio" name="escoamentoSanitario" id="semEsgoto" value="Não Possui Esgoto" class="form-check-input" <?php echo ($pessoa['ESCOA_SANITARIO'] == 'Não possui Esgoto' ? 'checked' : '') ?> />
          <label for="semEsgoto">Não possui esgoto</label>
        </div>
        <div>
          <label for="outraFormaEsgoto">Outra forma:</label>
          <input type="text" id="outraFormaEsgoto" name="outraFormaEsgoto" class="form-control" value="<?php echo $pessoa['OUTRA_FORMA_ESGOTO']; ?>" />
        </div>
        <div>
          <h5 class="sub-title">Benefícios Sociais</h5>
          <div class="form-check">
            <input type="radio" name="beneficiosSociais" id="naoBeneficiosSociais" value="Não" class="form-check-input"  <?php echo ($pessoa['BENEFICIOS_SOCIAIS'] == 'Não' ? 'checked' : '') ?> />
            <label for="naoBeneficiosSociais">Não</label>
          </div>
          <div>
            <input type="radio" name="beneficiosSociais" id="bolsaFamilia" value="Bolsa Família" class="form-check-input" <?php echo ($pessoa['BENEFICIOS_SOCIAIS'] == 'Bolsa Família' ? 'checked' : '') ?> />
            <label for="bolsaFamilia">Bolsa Família</label>
          </div>
          <div>
            <input type="radio" name="beneficiosSociais" id="auxilioEstadual" value="Auxílio Estadual" class="form-check-input" <?php echo ($pessoa['BENEFICIOS_SOCIAIS'] == 'Auxílio Estadual' ? 'checked' : '') ?> />
            <label for="auxilioEstadual">Auxílio Estadual</label>
          </div>
          <div>
            <input type="radio" name="beneficiosSociais" id="bpc" value="Benefício de Prestação Continuada (BPC)" class="form-check-input" <?php echo ($pessoa['BENEFICIOS_SOCIAIS'] == 'Benefício de Prestação Continuada (BPC)' ? 'checked' : '') ?> />
            <label for="bpc">Benefício de Prestação Continuada (BPC)</label>
          </div>
          <div>
            <label for="outroBeneficio">Outro:</label>
            <input type="text" id="outroBeneficio" name="outroBeneficio" class="form-control" value="<?php echo $pessoa['OUTROS_BENEFICIOS']; ?>"/>
          </div>
        </div>
        <br>
        <div>
          <label for="" class="form-label"> Situação do Cadastro Único:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="naoPossuiCadastroUnico" value="Não Possui CAD Único" class="form-check-input" <?php echo ($pessoa['SIT_CAD_UNICO'] == 'Não Possui CAD Único' ? 'checked' : '') ?> />
            <label for="naoPossuiCadastroUnico">Não Possui</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="atualizadoCadastroUnico" value="Atualizado" class="form-check-input" <?php echo ($pessoa['SIT_CAD_UNICO'] == 'Atualizado' ? 'checked' : '') ?> />
            <label for="atualizadoCadastroUnico">Atualizado</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="desatualizadoCadastroUnico" value="Desatualizado" class="form-check-input" <?php echo ($pessoa['SIT_CAD_UNICO'] == 'Desatualizado' ? 'checked' : '') ?> />
            <label for="desatualizadoCadastroUnico">Desatualizado</label>
          </div>
        </div>
        <br>
        
        <div class="mb-3">
          <h5 class="sub-title">Necessidades de Documentação Civil</h5>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="semNecessidade" value="Sem Necessidade" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'SEM NECESSIDADE' ? 'checked' : '') ?>/>
            <label for="cni">SEM NECESSIDADE</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="cni" value="CNI/RG" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'CNI/RG' ? 'checked' : '') ?>/>
            <label for="cni">CNI/RG</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="cpf" value="CPF" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'CPF' ? 'checked' : '') ?>/>
            <label for="cpf">CPF</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="rcn" value="RCN" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'RCN' ? 'checked' : '') ?>/>
            <label for="rcn">RCN</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="cpcd" value="Carteira PCD" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'CARTEIRA PCD' ? 'checked' : '') ?>/>
            <label for="cpcd">CARTEIRA PCD</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="cptea" value="Carteira CPTEA" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'CARTEIRA CIPTEA' ? 'checked' : '') ?>/>
            <label for="cptea">CARTEIRA CIPTEA</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="rnm" value="Registro Nacional dos Migrantes" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'REGISTRO NACIONAL DOS MIGRANTES' ? 'checked' : '') ?> />
            <label for="rnm">REGISTRO NACIONAL DOS MIGRANTES (RNM)</label>
          </div>
          <div class="form-check">
            <input type="checkbox" name="documentacaocivil[]" id="carteiraIdoso" value="Carteira do Idoso" class="form-check-input" <?php echo ($pessoa['DOCUM_CIVIL'] == 'CARTEIRA DO IDOSO' ? 'checked' : '') ?> />
            <label for="carteiraIdoso">CARTEIRA DO IDOSO</label>
          </div>
        </div>

        <div class="mb-3"  id="dynamic-content">

          <!-- SOCIOECONOMICO -->

          <h5>Socioêconomico</h5>
          <label for="nomeCompletoSocio" class="form-label">Nome Completo do Familiar:</label>
          <input type="text" id="nomesocio1" name="nomesocio[]" class="form-control" value="<?php echo $pessoa['NOME_FAMILIAR']; ?>"/>
          <label for="nomeCompletoSocio" class="form-label">Idade do Familiar:</label>
          <input type="text" id="idadesocio1" name="idadesocio[]" class="form-control" value="<?php echo $pessoa['IDADE_FAMILIAR']; ?>"/>
          <label for="" class="form-label">Vinculo Familiar:</label>
          <select id="relacao1" name="relacao[]" class="form-select">
            <option value="" selected disabled>Selecione uma opção</option>
            <option value="Pessoa de referência" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Pessoa de referência' ? 'selected' : '') ?>>Pessoa de referência</option>  
            <option value="Cônjugue/Companheiro(a)" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Cônjugue/Companheiro(a)' ? 'selected' : '') ?>>Cônjugue/Companheiro(a)</option>
            <option value="Filho(a)" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Filho(a)' ? 'selected' : '') ?>>Filho(a)</option>
            <option value="Enteado(a)" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Enteado(a)' ? 'selected' : '') ?>>Enteado(a)</option>
            <option value="Neto(a), Bisneto(a)" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Neto(a), Bisneto(a)' ? 'selected' : '') ?>>Neto(a), Bisneto(a)</option>
            <option value="Pai/Mãe" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Pai/Mãe' ? 'selected' : '') ?>>Pai/Mãe</option>
            <option value="Sogro(a)" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Sogro(a)' ? 'selected' : '') ?>>Sogro(a)</option>
            <option value="Irmão/Irmã" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Irmão/Irmã' ? 'selected' : '') ?>>Irmão/Irmã</option>
            <option value="Genro/Nora" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Genro/Nora' ? 'selected' : '') ?>>Genro/Nora</option>
            <option value="Outro Parente" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Outro Parente' ? 'selected' : '') ?>>Outro Parente</option>
            <option value="Não Parente" <?php echo ($pessoa['VINCULO_FAMILIAR'] == 'Não parente' ? 'selected' : '') ?>>Não Parente</option>
          </select>


            <label for="" class="form-label">Escolaridade:</label>        
          <select id="escolaridadeFam1" name="escolaridadeFam[]" class="form-select">
          <option value="<?php echo $pessoa['ESCOLARIDADE_FAMILIAR']; ?>" selected disabled>Selecione uma opção</option>
              <option value="Não Alfabetizado" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Não Alfabetizado' ? 'selected' : '') ?>>Não Alfabetizado</option>
              <option value="Ens. Fundamental Completo" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Ens. Fundamental Completo' ? 'selected' : '') ?>>Ens. Fundamental Completo</option>
              <option value="Ens. Fundamental Incompleto" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Ens. Fundamental Incompleto' ? 'selected' : '') ?>>Ens. Fundamental Incompleto</option>
              <option value="Ens. Médio Completo" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Ens. Médio Completo' ? 'selected' : '') ?>>Ens. Médio Completo</option>
              <option value="Ens. Médio Incompleto" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Ens. Médio incompleto' ? 'selected' : '') ?>>Ens. Médio Incompleto</option>
              <option value="Ens. Superior Completo" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Ens. Superior Completo' ? 'selected' : '') ?>>Ens. Superior Completo</option>
              <option value="Ens. Superior Incompleto" <?php echo ($pessoa['ESCOLARIDADE_FAMILIAR'] == 'Ens. Superior Incompleto' ? 'selected' : '') ?>>Ens. Superior Incompleto</option>
          </select>


              <label for="" class="form-label">Tipo de PCD:</label>        
              <select id="deficiencia1" name="deficiencia[]" class="form-select">
              <option value="<?php echo $pessoa['TIPO_PCD']; ?>" selected disabled>Selecione uma opção</option>
                  <option value="Sem Deficiência" <?php echo ($pessoa['TIPO_PCD'] == 'Sem Deficiência' ? 'selected' : '') ?>>Sem Deficiência</option>
                  <option value="Visual" <?php echo ($pessoa['TIPO_PCD'] == 'Visual' ? 'selected' : '') ?>>Visual</option>
                  <option value="Auditiva" <?php echo ($pessoa['TIPO_PCD'] == 'Auditiva' ? 'selected' : '') ?>>Auditiva</option>
                  <option value="Mental" <?php echo ($pessoa['TIPO_PCD'] == 'Mental' ? 'selected' : '') ?>>Mental</option>
                  <option value="Física" <?php echo ($pessoa['TIPO_PCD'] == 'Física' ? 'selected' : '') ?>>Física</option>
                  <option value="Múltipla" <?php echo ($pessoa['TIPO_PCD'] == 'Múltipla' ? 'selected' : '') ?>>Múltipla</option>
              </select>

                  <label for="" class="form-label">Necessidade de Documentação:</label>        
                  <select id="documentacao1" name="documentacao[]" class="form-select">
                  <option value="" selected disabled>Selecione uma opção</option>
                      <option value="Sem Necessidade" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'SEM NECESSIDADE' ? 'selected' : '') ?>>SEM NECESSIDADE</option>
                      <option value="CIN/RG" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'CIN/RG' ? 'selected' : '') ?>>CIN/RG</option>
                      <option value="CPF" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'CPF' ? 'selected' : '') ?>>CPF</option>
                      <option value="Carteira PCD" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'PCD' ? 'selected' : '') ?>>CARTEIRA PCD</option>
                      <option value="RCN" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'RNC' ? 'selected' : '') ?>>RCN</option>
                      <option value="Carteira CIPTEA" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'CARTEIRA CIPTEA' ? 'selected' : '') ?>>CARTEIRA CIPTEA</option>
                      <option value="Carteira IDOSO" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'CARTEIRA DO IDOSO' ? 'selected' : '') ?>>CARTEIRA IDOSO</option>
                      <option value="RNM" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'RNM' ? 'selected' : '') ?>>RNM</option>
                      <option value="Outra" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'OUTRA' ? 'selected' : '') ?>>OUTRA</option>
                  </select>
                          <br>       

                            </div>
                            <!-- BTN Adicionar Cadastro -->
                            <div class="d-flex">
                            <div class="justify-content-center">
                              <button class="btn-cad" type="button" onclick="adicionarLinha()" style="font-size:15px; ">Adicionar Novo Cadastro</button>
                            </div>
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
      <label for="nomeCompletoSocio" class="form-label">Nome Completo do Familiar:</label>
      <input type="text" id="nomesocio${contador}" name="nomesocio[]" class="form-control"/>
        <label for="idadeSocio" class="form-label">Idade do Familiar:</label>
        <input type="text" id="idadesocio${contador}" name="idadesocio[]" class="form-control" placeholder="Digite Apenas Números"/>
        <label for="relacao" class="form-label">Vínculo Familiar:</label>
        <select id="relacao${contador}" name="relacao[]" class="form-select">
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
      <label for="escolaridade" class="form-label">Escolaridade:</label>
      <select id="escolaridadeFam${contador}" name="escolaridadeFam[]" class="form-select">
        <option value="" selected disabled>Selecione uma opção</option>
        <option value="Não Alfabetizado">Não Alfabetizado</option>
        <option value="Ens. Fundamental Completo">Ens. Fundamental Completo</option>
        <option value="Ens. Fundamental Incompleto">Ens. Fundamental Incompleto</option>
        <option value="Ens. Médio Completo">Ens. Médio Completo</option>
        <option value="Ens. Médio Incompleto">Ens. Médio Incompleto</option>
        <option value="Ens. Superior Completo">Ens. Superior Completo</option>
        <option value="Ens. Superior Incompleto">Ens. Superior Incompleto</option>
      </select>
      <label for="deficiencia" class="form-label">Tipo de PCD:</label>
      <select id="deficiencia${contador}" name="deficiencia[]" class="form-select">
        <option value="" selected disabled>Selecione uma opção</option>
        <option value="Sem Deficiência">Sem Deficiência</option>
        <option value="Visual">Visual</option>
        <option value="Auditiva">Auditiva</option>
        <option value="Mental">Mental</option>
        <option value="Física">Física</option>
        <option value="Múltipla">Múltipla</option>
      </select>
      <label for="documentacao" class="form-label">Necessidade de Documentação:</label>
      <select id="documentacao${contador}" name="documentacao[]" class="form-select">
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
      <br>
      <button type="button" onclick="removerLinha(this)" style="font-size:15px;" >Remover Cadastro</button>

      
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
        <div class="mb-3"> 
    <h5 class="sub-title">Encaminhamentos/Agendamentos</h5>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="semNecessidade" value="Sem Necessidade" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'SEM NECESSIDADE' ? 'checked' : '') ?>
 />
        <label for="cni">SEM NECESSIDADE DE ENCAMINHAMENTO</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento1" value="SEJUSC Cidadania (CPF,RCN)" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'SEJUSC Cidadania (CPF,RCN)' ? 'checked' : '') ?> />
        <label for="encaminhamento1">SEJUSC CIDADANIA (CPF,RCN)</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento2" value="SEJUSC PCD" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'SEJUSC PCD' ? 'checked' : '') ?> />
        <label for="encaminhamento2">SEJUSC PCD</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento3" value="Inserção/Atualização CADÚNICO-SEMASC" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'Inserção/Atualização CADÚNICO-SEMASC' ? 'checked' : '') ?> />
        <label for="encaminhamento3">INSERÇÃO/ATUALIZAÇÃO CADÚNICO-SEMASC</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento4" value="Curso de Defesa Pessoal Para Mulheres - SEDEL" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'Curso de Defesa Pessoal Para Mulheres - SEDEL' ? 'checked' : '') ?> />
        <label for="encaminhamento4">CURSO DE DEFESA PESSOAL PARA MULHERES - SEDEL</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento5" value="Escritório Social - SEAP" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'Escritório Social - SEAP' ? 'checked' : '') ?> />
        <label for="encaminhamento5">ESCRITÓRIO SOCIAL - SEAP</label>
    </div>
    <div class="form-check">
        <input type="checkbox" name="encaminhamentosAgendados[]" id="encaminhamento6" value="Curso de Capacitação Profissional" class="form-check-input" <?php echo ($pessoa['NECES_DOC_FAMILIAR'] == 'Curso de Capacitação Profissional' ? 'checked' : '') ?> />
        <label for="encaminhamento6">CURSO DE CAPACITAÇÃO PROFISSIONAL</label>
    </div>

    <div class="mb-3">
        <label for="nomeCompletoTec" class="form-label">Nome completo do Técnico:</label>
        <input type="text" id="nomeCompletoTec" name="nomeCompletoTec" class="form-control" value="<?php echo $pessoa['TECNICO_RESPONSAVEL']; ?>" required/>
    </div>   

    </div>

        <a href="listar1.php"><button type="submit" name="submit" id="submit">Atualizar</button></a>
        
      
      </div>
      
    </div>

    

    <!-- Bibliteca de máscaras -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.16/jquery.mask.min.js"></script>

    <!-- Mascara do CPF e NIS -->
              <script>
            $(document).ready(function() {
              // Máscara para CPF
              $('#cpf').mask('000.000.000-00', {reverse: true});
              
              // Máscara para NIS
              $('#numNIS').mask('00000000000');

              // Máscara para a Renda
              $('#renda').mask('000.000.000.000,00', {reverse: true});

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