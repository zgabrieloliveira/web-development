function ideal_weight() {
    // obtendo altura preenchida via seletor de id
    let heightValue  = parseInt(document.getElementById('height').value)
    // vai armazenar o resultado do calculo
    let ideal_weight = 0
    // vai armazenar a string do resultado da operacao
    let result = document.getElementById('result')
    // obtendo valor do gênero selecionado diretamente
    const selectedGenderRadio = document.querySelector('input[name="gender"]:checked');
    if (selectedGenderRadio) {
        genderValue = selectedGenderRadio.value;
    }

    result.textContent = 'Dados Invalidos!' // valor padrao

    // calculo de peso ideal baseado no sexo
    switch(genderValue) {
        case 'feminine':
            ideal_weight = 52 + (0.67 * (heightValue - 152.4))
            break;
        case 'masculine':
            ideal_weight = 52 + (0.75 * (heightValue - 152.4))
            break;
        default:
            break;
    }
    
    // a string de resultado so vai mudar se o peso ideal puder ser calculado
    if (ideal_weight != 0) result.textContent = `O seu peso ideal: ${ideal_weight.toFixed(2)}`
}

const button = document.querySelector('button')
button.onclick = ideal_weight