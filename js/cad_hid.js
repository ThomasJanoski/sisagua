function mascara_hora(horacoleta) {
    let valor = horacoleta
    valor = valor.replace(/[^0-9]/g, "")

    if (valor.length >= 3) {
        valor = `${valor.slice(0, 2)}:${valor.slice(2, 4)}`
    }
    valor = valor.slice(0, 5)

    document.forms[0].horacoleta.value = valor
}

function total(hidrometro, hidrometro2) {
    return parseFloat(hidrometro) - parseFloat(hidrometro2);
}

function calcularhidrometro() {
    var hidrometro = document.getElementById("val_hidrometro").value
    var hidrometro2 = document.getElementById("ultimo_hidrometro").value

    var ContainerResultado = document.getElementById("resultado")
    var ContainerHidCal = document.getElementById("hid_cal")

    function adicionarClasse(nomeClasse) {
        ContainerResultado.classList.remove("alert-success")
        ContainerResultado.classList.remove("alert-warning")
        ContainerResultado.classList.remove("alert-danger")

        ContainerResultado.classList.add(nomeClasse)
    }

    var calculo = total(hidrometro, hidrometro2)
    let resultado = (calculo < 0) ? "Valor Negativo" : (calculo <= 23) ? "Normal" : (calculo <= 28) ? "Pouco Acima do Normal" : "Acima do Normal"

    if (calculo < 0) {
        adicionarClasse("alert-danger")
    } else {
        adicionarClasse(resultado == "Normal" ? "alert-success" : "alert-warning")
    }

    ContainerResultado.innerHTML = resultado
    ContainerHidCal.value = resultado
}

function formatarHidrometro(numero) {
    // Remove tudo que não é número
    let valor = numero.toString().replace(/\D/g, "");

    // Verifica se o valor está vazio
    if (valor === "") {
        valor = "0.000"; // Retorna um valor padrão
    }

    // Caso tenha menos de 3 dígitos, adiciona zeros à esquerda
    if (valor.length <= 3) {
        valor = valor.padStart(3, "0");
        valor = "0." + valor;
    } else {
        // Caso tenha mais de 3 dígitos, separa parte inteira e decimal
        let parteInteira = valor.slice(0, -3);
        let parteDecimal = valor.slice(-3);
        valor = parteInteira + "." + parteDecimal;
    }

    return parseFloat(valor).toFixed(3)
}

function trocaHidrometro(input) {
    var ContainerUltimoHidrometro = document.getElementById("ultimo_hidrometro")
    var ContainerTotal = document.getElementById("total")

    input.value = formatarHidrometro(input.value)

    var result = total(input.value, ContainerUltimoHidrometro.value)
    ContainerTotal.innerHTML = Number.isNaN(result) ? -ContainerUltimoHidrometro.value : result.toFixed(3)

    calcularhidrometro()
}

async function fazerRequisicao(hidrometroSelecionado) {
    try {
        const response = await fetch("bd_ultimo_hid.php", {
            method: "POST",
            headers: {
                "Content-Type": "application/x-www-form-urlencoded"
            },
            body: `hidrometro_selecionado=${encodeURIComponent(hidrometroSelecionado)}`
        });

        if (!response.ok) {
            throw new Error(`Erro: ${response.status}`);
        }

        const respostaTexto = await response.text(); // Retorna o texto da resposta
        return respostaTexto;
    } catch (erro) {
        console.error("Erro durante a requisição:", erro);
        throw erro; // Propaga o erro
    }
}

async function trocaHidrometroSelecionado(nomeHidrometro) {
    try {
        const resposta = await fazerRequisicao(nomeHidrometro);
        document.getElementById("ultimo_hidrometro").value = resposta;
        trocaHidrometro(document.getElementById("val_hidrometro"))
    } catch (erro) {
        console.error("Erro:", erro);
    }
}

trocaHidrometroSelecionado(document.getElementById("hidrometro").value)