
<?php
 

  if(isset($_POST['submit']))
  {
      
      
      // print_r('Nome: '. $_POST['nome']);
      // print_r('</br>');
      // print_r('Data Nasc: '. $_POST['dataNascimento']);
      // print_r('</br>');
      // print_r('CPF: '. $_POST['cpf']);
      // print_r('</br>');
      

      include_once('config.php');

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
      $escolaridade = $_POST['escolaridade'];
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
      $encaminhamentos = $_POST['encaminhamentosAgendados'];
      $tecnico_responsavel = $_POST['nomeCompletoTec'];

      $result = mysqli_query($conexao, "INSERT INTO pessoa(nome, data_nasc, cpf, numero_nis, genero, 
      estado_civil, outro_estado_civil, cor_raca, nacionalidade, naturalidade, escolaridade, profissao, 
      renda, ocupacao_profissional, outra_ocupacao, end_cep, end_rua, end_num, end_bairro, end_p_referencia, 
      telefone, oferta_whatsapp, tipo_residencia, estrutura_residencia, outros_materiais, energia_eletrica, 
      abast_agua, outra_forma_agua, escoa_sanitario, outra_forma_esgoto, beneficios_sociais, 
      outros_beneficios, sit_cad_unico, docum_civil, encaminhamentos, tecnico_responsavel)
      VALUES ('$nome', '$data_nasc','$cpf', '$nis', '$genero', '$estado_civil', '$outro_Estado_civil', 
      '$cor_raca', '$nacionalidade', '$naturalidade', '$escolaridade', '$profissao', '$renda', '$ocupacao_profissional', 
      '$outra_ocupacao', '$cep', '$rua', '$numero', '$bairro', '$referencia', '$telefone', '$whatsapp', 
      '$tipo_reside', '$tipo_estrut', '$outras_estrut', '$energia_eletrica', '$abastece_agua', '$outro_abastecimento', 
      '$escoa_sanitario', '$outra_sanitario', '$benef_sociais', '$outros_beneficios', '$cad_unico', '$doc_civil', 
      '$encaminhamentos', '$tecnico_responsavel')");

      header("Location: formulario_enviado.php");
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
  <link rel="shortcut icon" href="/img/Logo-SSP-Am-novo-300x298.png" type="image/x-icon">
  <link rel="import" href="cadastro.html">

  <link rel="stylesheet" href="css/styles.css" />
  <script src="./services/form.js" defer></script>
  <title>Cidadania e Segurança</title>
</head>

<body>
  <div class="title">
    <h3>Formulário - Cidadania e Segurança</h3>
  </div>

  <form action="form.php" method="post" id="myForm">
    <div class="container">
      <div>
        <br>
        <h5 class="sub-title">Identificação</h5>
        <div class="mb-3">
          <label for="nomeCompleto" class="form-label">Nome Completo:</label>
          <input type="text" id="nome" name="nome" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="dataNascimento" class="form-label">Data de Nascimento:</label>
          <input type="date" id="dataNascimento" name="dataNascimento" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="cpf" class="form-label">CPF:</label>
          <input type="text" id="cpf" name="cpf" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="numNIS" class="form-label">NÚMERO DO NIS:</label>
          <input type="text" id="numNIS" name="numNIS" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="genero" class="form-label">Gênero:</label>
          <select name="genero" id="genero" class="form-select">
            <option value="">Selecione uma opção</option>
            <option value="feminino">Mulher Cisgênero</option>
            <option value="masculino">Homem Cisgênero</option>
            <option value="naoResponder">Transexual</option>
            <option value="outro">Outro</option>
          </select>
        </div>

        <div class="mb-3">
          <label class="form-label">Estado Civil:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="estadoCivil" id="solteiro" value="solteiro" class="form-check-input" /><label
              for="solteiro" class="form-check-label">Solteiro</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="estadoCivil" id="casado" value="casado" class="form-check-input" /><label
              for="casado">Casado</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="estadoCivil" id="divorciado" value="divorciado" class="form-check-input" /><label
              for="divorciado">Divorciado</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="estadoCivil" id="uniaoEstavel" value="uniaoEstavel"
              class="form-check-input" /><label for="uniaoEstavel">União Estável</label>
          </div>
          <div class="">
            <label for="outro" class="form-label">Outro: </label> <input type="text" name="outroEstadoCivil" id="outro"
              class="form-control" />
          </div>
        </div>

        <div class="mb-3">
          <label class="form-label">Cor/Raça:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="cor" id="branca" value="branca" class="form-check-input" /><label
              for="branca">Branca</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="cor" id="preta" value="preta" class="form-check-input" /><label
              for="preta">Preta</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="parda" value="parda" class="form-check-input" /><label
              for="parda">Parda</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="indigena" value="indigena" class="form-check-input" /><label
              for="indigena">Indígena</label>
          </div>
          <div class="form-check form-check-inline ">
            <input type="radio" name="cor" id="naoDeclarado" value="naoDeclarado" class="form-check-input" /><label
              for="naoDeclarado">Não Declarado</label>
          </div>
          <div class="form-check  form-check-inline">
            <input type="radio" name="cor" id="outra" value="outra" class="form-check-input" /><label
              for="outra">Outra</label>
          </div>
        </div>
        <div class="mb-3">
          <label for="nacionalidade" class="form-label">Nacionalidade:</label>
          <input type="text" id="nacionalidade" name="nacionalidade" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="naturalidade" class="form-label">Naturalidade:</label>
          <input type="text" id="naturalidade" name="naturalidade" class="form-control" />
        </div>
        <div class="mb-3">
          <label for="escolaridade" class="form-label">Escolaridade</label>
          <select name="escolaridade" id="escolaridade" class="form-select">
            <option value="">Selecione uma opção</option>
            <option value="analfabeto">Analfabeto</option>
            <option value="fundamentalIncompleto">Fundamental Incompleto</option>
            <option value="fundamentalCompleto">Fundamental Completo</option>
            <option value="medioIncompleto">Médio Incompleto</option>
            <option value="medioCompleto">Médio Completo</option>
            <option value="superiorIncompleto">Superior Incompleto</option>
            <option value="superiorCompleto">Superior Completo</option>
            <option value="posGraduacao">Pós Graduação</option>
          </select>
        </div>
        <div class="mb-3">
          <label for="profissao" class="form-label">Profissão</label>
          <input type="text" id="profissao" name="profissao" class="form-control" />
        </div>
        <div>
          <label for="renda" class="form-label">Renda</label>
          <input type="text" id="renda" name="renda" class="form-control" />
        </div>
        <div class="mb-3">
          <label class="form-label">Ocupação Profissional:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="clt" value="clt" class="form-check-input" /><label
              for="clt">CLT</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="contrato" value="contrato" class="form-check-input" /><label
              for="contrato">Contrato</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="autonomo" value="autonomo" class="form-check-input" /><label
              for="autonomo">Autônomo</label>
          </div>
          <div class="form-check form-check-inline">
            <input type="radio" name="ocupacao" id="desempregado" value="desempregado" class="form-check-input" /><label
              for="desempregado">Desempregado</label>
          </div>
          <div>
            <label for="outraOcupacao" class="form-label">Outra:</label>
            <input type="text" id="outraOcupacao" name="outraOcupacao" class="form-control" />
          </div>
        </div>
      </div>

      <!---->
      <div class="mb-3">
        <h5 class="sub-title">Endereço/Contato</h5>
        <div>
          <div class="mb-3">
            <label for="cep" class="form-label">CEP</label>
            <input type="text" class="form-control" id="cep" name="cep">
          </div>
          <div class="row">
            <div class="col">
              <label for="rua" class="form-label">Rua/Avenida</label>
              <input type="text" class="form-control" style="width: 25rem;" id="rua" name="rua">
            </div>
            <div class="col">
              <label for="numero" class="form-label">Número:</label>
              <input type="text" class="form-control" id="numero" name="numero">
            </div>
          </div>
          <div class="mb-3">
            <label for="bairro" class="form-label">Bairro</label>
            <input type="text" class="form-control" id="bairro" name="bairro">
          </div>
          <div class="mb-3">
            <label for="referencia" class="form-label">Ponto de Referência</label>
            <input type="text" class="form-control" id="referencia" name="referencia">
          </div>
          <div class="mb-3">
            <label for="telefone" class="form-label">Telefone para contato</label>
            <input type="text" class="form-control" id="telefone" name="telefone" placeholder="(DDD) 0000-0000">
          </div>

          <div class="mb-3">
            <label for="whatsapp">Aceita ser inserido em grupo de oferta de serviços no WhatsApp?</label>
            <div class="form-check form-check-inline">
              <input type="radio" name="aceitaWhatsapp" id="sim" value="sim" class="form-check-input" />
              <label for="sim">Sim</label>
            </div>
                   
            <div class="form-check form-check-inline">
              <input type="radio" name="aceitaWhatsapp" id="nao" value="não" class="form-check-input" />
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
          <input type="radio" name="tipoResidencia" id="propria" value="própria" class="form-check-input" />
          <label for="propria" class="form-check-label">Própria</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="alugada" value="alugada" class="form-check-input" />
          <label for="alugada">Alugada</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="cedida" value="cedida" class="form-check-input" />
          <label for="cedida">Cedida</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoResidencia" id="ocupada" value="ocupada" class="form-check-input" />
          <label for="ocupada" class="form-check-label">Ocupada</label>
        </div>
        <br>
        <label for="" class="form-label">Tipo de Estrutura:</label>
        <br>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoEstrutura" id="alvenaria" value="alvenaria" class="form-check-input" />
          <label for="alvenaria">Alvenaria</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoEstrutura" id="madeira" value="madeira" class="form-check-input" />
          <label for="madeira">Madeira</label>
        </div>
        <div class="form-check form-check-inline">
          <input type="radio" name="tipoEstrutura" id="mista" value="mista" class="form-check-input" />
          <label for="mista">Mista</label>
        </div>
        <br>
        <div class="">
          <label for="outrosMateriais">Outros Materiais:</label>
          <input type="text" id="outrosMateriais" name="outrosMateriais" class="form-control" />
        </div>

        <label for="" class="form-label">Energia Elétrica:</label>
        <br>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="comMedidorProprio" value="COM MEDIDOR PRÓPRIO" class="form-check-input" />
          <label for="comMedidorProprio">Sim, com medidor próprio</label>
        </div>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="comMedidorCompartilhado" value="COM MEDIDOR COMPARTILHADO" class="form-check-input" />
          <label for="comMedidorCompartilhado">Sim, com medidor compartilhado</label>
        </div>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="semMedidor" value="SEM MEDIDOR" class="form-check-input" />
          <label for="semMedidor">Sim, sem medidor</label>
        </div>
        <div class="form-check">
          <input type="radio" name="energiaEletrica" id="semEnergiaEletrica" value="SEM ENERGIA ELÉTRICA" class="form-check-input" />
          <label for="semEnergiaEletrica">Não possui energia elétrica</label>
        </div>
        <label for="" class="form-label">Abastecimento de Água:</label>
        <div class="form-check">
          <input type="radio" name="abastecimentoAgua" id="redeGeralDistribuicao" value="Rede geral de distribuição" class="form-check-input" />
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
        <div>
          <label for="outraFormaAgua">Outra forma:</label>
          <input type="text" id="outraFormaAgua" name="outraFormaAgua" class="form-control" />
        </div>
        <label for="" class="form-label">Escoamento Sanitário:</label>
        <div>
          <input type="radio" name="escoamentoSanitario" id="redeGeralDistribuicaoSanitario" value="Rede Geral de Distribuição" class="form-check-input" />
          <label for="redeGeralDistribuicaoSanitario">Rede geral de distribuição</label>
        </div>
        <div>
          <input type="radio" name="escoamentoSanitario" id="pocoArtesianoSanitario" value="Poço artesiano" class="form-check-input" />
          <label for="pocoArtesianoSanitario">Poço artesiano</label>
        </div>
        <div>
          <input type="radio" name="escoamentoSanitario" id="semEsgoto" value="Não Possui Esgoto" class="form-check-input" />
          <label for="semEsgoto">Não possui esgoto</label>
        </div>
        <div>
          <label for="outraFormaEsgoto">Outra forma:</label>
          <input type="text" id="outraFormaEsgoto" name="outraFormaEsgoto" class="form-control" />
        </div>
        <div>
          <h5 class="sub-title">Benefícios Sociais</h5>
          <div class="form-check">
            <input type="radio" name="beneficiosSociais" id="naoBeneficiosSociais" value="Não" class="form-check-input" />
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
          <div>
            <label for="outroBeneficio">Outro:</label>
            <input type="text" id="outroBeneficio" name="outroBeneficio" class="form-control" />
          </div>
        </div>
        <br>
        <div>
          <label for="" class="form-label"> Situação do Cadastro Único:</label>
          <br>
          <div class="form-check form-check-inline">
            <input type="radio" name="situacaoCadastroUnico" id="naoPossuiCadastroUnico" value="Não Possui CAD Único" class="form-check-input" />
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
        <br>
        <div class="mb-3">
          <h5 class="sub-title">Necessidades de Documentação Civil</h5>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="semNecessidade" value="SEM NECESSIDADE" class="form-check-input" />
            <label for="cni">SEM NECESSIDADE</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="cni" value="CNI/RG" class="form-check-input" />
            <label for="cni">CNI/RG</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="cpf" value="CPF" class="form-check-input" />
            <label for="cpf">CPF</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="rcn" value="RCN" class="form-check-input" />
            <label for="rcn">RCN</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="cpcd" value="CARTEIRA PCD" class="form-check-input" />
            <label for="cpcd">CARTEIRA PCD</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="cptea" value="CARTEIRA CPTEA" class="form-check-input" />
            <label for="cptea">CARTEIRA CIPTEA</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="rnm" value="REGISTRO NACIONAL DOS MIGRANTES" class="form-check-input" />
            <label for="rnm">REGISTRO NACIONAL DOS MIGRANTES (RNM)</label>
          </div>
          <div class="form-check">
            <input type="radio" name="documentacaocivil" id="carteiraIdoso" value="CARTEIRA DO IDOSO" class="form-check-input" />
            <label for="carteiraIdoso">CARTEIRA DO IDOSO</label>
          </div>
        </div>
        <div class="mb-3"> 
            <h5 class="sub-title">Encaminhamentos</h5>
          <div class="form-check">
            <input type="radio" name="encaminhamentosAgendados" id="semNecessidade" value="SEM NECESSIDADE DE ENCAMINHAMENTO" class="form-check-input" />
            <label for="cni">SEM NECESSIDADE DE ENCAMINHAMENTO</label>
          </div>
          <div class="">
          <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoCNI" value="CPF"  class="form-check-input"/>
          <label for="encaminhamentoCNI">CPF</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoRCN" value="RCN" class="form-check-input" />
            <label for="encaminhamentoRCN">RCN</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoCarteiraCIPTEA" value="Carteira CIPTEA" class="form-check-input" />
            <label for="encaminhamentoCarteiraCIPTEA">Carteira CIPTEA</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="encaminhamentoCarteiraPCD" value="Carteira do Idoso" class="form-check-input"/>
            <label for="encaminhamentoCarteiraPCD">Carteira Do Idoso</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="insercaoAtualizacaoCADUNICO" value="Inserção/Atualização CADÚNICO" class="form-check-input" />
            <label for="insercaoAtualizacaoCADUNICO">Inserção/Atualização CADÚNICO</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="projetoPermanecerSEDUC" value="Projeto Permanecer - SEDUC (em casos de evasão escolar)" class="form-check-input" />
            <label for="projetoPermanecerSEDUC">Projeto Permanecer - SEDUC (em casos de evasão escolar)</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="cursosCapacitacaoProfissional" value="Cursos de Defesa Pessoal Para Mulheres" class="form-check-input" />
            <label for="cursosCapacitacaoProfissional">Cursos de Defesa Pessoal Para Mulheres</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="cursosCapacitacaoProfissional" value="Programa Empreender no Envelhecer (em casos de microcrédito para idoso)" class="form-check-input" />
            <label for="cursosCapacitacaoProfissional">Programa Empreender no Envelhecer (em casos de microcrédito para idoso)</label>
          </div>
          <div>
            <input type="radio" name="encaminhamentosAgendados" id="cursosCapacitacaoProfissional" value="Idoso em Movimento(em caso de atividade físicas em grupos de idosos)" class="form-check-input" />
            <label for="cursosCapacitacaoProfissional">Idoso em Movimento(em caso de atividade físicas em grupos de idosos)</label>
          </div>
          <br>
          <div class="mb-3">
                <label for="nomeCompletoTec" class="form-label">Nome completo do Técnico:</label>
                <input type="text" id="nomeCompletoTec" name="nomeCompletoTec" class="form-control" required/>
            </div>
        </div>
        <button type="submit" name="submit" id="submit">Enviar</button>
        <!-- <input type="submit" name="submit" id="submit"> -->
      <!-- <button><a href="cadastro.php">Avançar</a></button> -->
      
      </div>
      <!-- <input type="submit" name="submit" id="submit"> -->
    </div>
  </form>

</body>

</html>