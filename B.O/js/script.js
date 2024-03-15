import axios from 'axios';

let formComunicante = document.getElementById("formComunicante");

formComunicante.addEventListener("submit", (e) => {
    e.preventDefault();

    let formData = new FormData(e.target)

    let dadosComunicante = {
        nomecivil: formData.get('nome_comunicante'),
        nacionalidade: formData.get('nacionalidade_comunicante'),
        profissao: formData.get('profissao'),
        estadocivil: formData.get('estado_civil_comunicante'),
        nomemae: formData.get('nome_mae_comunicante'),
        cpf: formData.get('cpf'),
        endereco: formData.get('endereco'),
        telefone: formData.get('telefone'),
        naturalidade: formData.get('naturalidade'),
        datanasc: formData.get('data_nasc_comunicante'),
        idade: formData.get('idade_comunicante')
    }

    localStorage.setItem("dadosComunicante", JSON.stringify(dadosComunicante));
    const armazenar = localStorage.getItem(dadosComunicante);

    console.log(dadosComunicante)
    cadastrar(dadosComunicante)
});

function cadastrar(dadosComunicante) {
    axios.post("http://localhost:8080/api/comunicantes", dadosComunicante)
    .then(function (res) {
        console.log("Sucesso!")
        console.log(res)
    })
    .catch(function (res) {
        console.log("Erro!")
        console.log(res)
    })
}