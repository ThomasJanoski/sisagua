function formatNumber(inputElement) {
    // Remove tudo que não for número
    let value = inputElement.value.replace(/\D/g, '');
    const maxLength = 7; // Quantidade máxima de números antes do formato

    // Limita os dígitos a 7
    value = value.substring(0, maxLength);

    // Aplica a formatação dinâmica
    let formattedValue = '';

    if (value.length > 0) {
        formattedValue += value.substring(0, 3); // Primeiros 3 dígitos
    }
    if (value.length > 3) {
        formattedValue += '.' + value.substring(3, 6); // Próximos 3 dígitos
    }
    if (value.length > 6) {
        formattedValue += '-' + value.substring(6, 7); // Último dígito
    }

    // Atualiza o campo de entrada com o valor formatado
    inputElement.value = formattedValue;
}