function trocaHidrometroSelecionado(nomeHidrometro) {
    console.log("A")
    window.location.href = `rel_individual.php?${new URLSearchParams({ hidrometro_selecionado: nomeHidrometro }).toString()}`
}
