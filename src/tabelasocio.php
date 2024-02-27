

<!DOCTYPE html>
<html lang="pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Página</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="css/tabela.css">
</head>
<body>
    <form action="">
        <div class="container">
            <h5 class="sub-title">Tabela socioeconomico</h5>
            <div class="table-responsive">
                <table id="dynamic-table" class="table">
                    <thead>
                        <tr>
                            <th>Ord.</th>
                            <th style="width: 12%">Nome completo</th>
                            <th>Idade</th>
                            <th style="width: 14%">Vinculo Familiar (*)</th>
                            <th>Escolaridade(**)</th>
                            <th style="width: 10%; font-size: 15px">Identificar PCD conforme o código(***)</th>
                            <th>Necessidade de Documentação(****)</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>1</td>
                            <td><input type="text" class="" style="width: 100%"></td>
                            <td><input type="text" class=""></td>
                            <td><input type="text" class=""></td>
                            <td><input type="text" class=""></td>
                            <td><input type="text" class=""></td>
                            <td style="width: 56%">
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input">
                                    <label for="">CIN/RG</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input" />
                                    <label for="">CPF</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input"  />
                                    <label for="">CARTEIRA PCD</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input" />
                                    <label for="">RCN</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input" />
                                    <label for="">CARTEIRA CIPTEA</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input" />
                                    <label for="">CARTEIRA IDOSO</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input" />
                                    <label for="">RNM</label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input type="radio" name="" id="" class="form-check-input" />
                                    <label for="">OUTRA</label>
                                </div>

                                <!-- Outros radio buttons aqui -->
                            </td>
                        </tr>
                        <!-- Adicione mais linhas aqui dinamicamente -->
                    </tbody>
                </table>
            </div>
            <!-- <input type="submit" name="submit" id="submit"> -->
            <button><a href="cadastro.php">Avançar</a></button>
        </div>
    </form>
    <div class="legenda">
        <h5 class="sub-title">Legenda de Códigos</h5>
        <p><strong>* Vinculo familiar:</strong> 1-Pessoa de Referência; 2- Cônjugue/Companheiro(a); 3-Filho(a);<br>4-Enteado(a); 5-Neto(a),Bisneto(a); 6-Pai/Mãe; 7-Sogro(a);<br>8- Irmão/Irmã; 9-Genro/Nora; 10- Outro Parente; 11-Não parente.</p>
        <p><strong>**Escolaridade:</strong>1 - Não Alfabetizado; 2 - Ensi. Fundamental <br>Completo; 3 - Ens. Fundamental Incompleto; 4 - Ens. Médio Completo,<br>5 - Ens. Médio Incompleto; 6-ens. Superior Completo; 7 - Ens. Superior Incompleto.</p>
        <p><strong>***Código Deficiência:</strong> 1 - Visual; 2 - Auditiva; 3- Mental; 5 - Física; 6 - Múltipla</p>
        <p><strong>****Documentação a ser providenciada:</strong> RCN - Registro Civil de Nascimento; RNM - Registro Nacional dos Migrantes;<br>CIPTEA - Carteira de Identificação da Pessoa com Transtorno do Espectro Autista;</p>
    </div>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const tableBody = document.querySelector("#dynamic-table tbody");

            tableBody.addEventListener("input", function(event) {
                const target = event.target;
                if (target.tagName === "INPUT" && target.closest("tr") === tableBody.lastElementChild) {
                    const newRow = document.createElement("tr");
                    newRow.innerHTML = `
                        <td>${tableBody.children.length + 1}</td>
                        <td><input type="text" class=""></td>
                        <td><input type="text" class=""></td>
                        <td><input type="text" class=""></td>
                        <td><input type="text" class=""></td>
                        <td><input type="text" class=""></td>
                        <td style="width: 56%;"> 
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id=""  class="form-check-input" />
                                <label for="">CIN/RG</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input" />
                                <label for="">CPF</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input"  />
                                <label for="">CARTEIRA PCD</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input" />
                                <label for="">RCN</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input" />
                                <label for="">CARTEIRA CIPTEA</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input" />
                                <label for="">CARTEIRA IDOSO</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input" />
                                <label for="">RNM</label>
                            </div>
                            <div class="form-check form-check-inline">
                                <input type="radio" name="" id="" class="form-check-input" />
                                <label for="">OUTRA</label>
                            </div>
                            
                        </td>
                    `;
                    tableBody.appendChild(newRow);
                }
            });
        });
    </script>
</body>
</html>
