// acionada quando os botoes da nav forem clicados
function changeTab(e) {
    const button = e.target; // pega o botão clicado
    const navBarItem = button.parentNode; // pega o pai do botão clicado (li)
    const nodes = Array.from(navBarItem.parentNode.children); // pega todos os filhos do pai do botão clicado (todos os li)
    const index = nodes.indexOf(navBarItem); // pega o index do pai do botão clicado
    openTab(index); // chama a função openTab passando o index do botão clicado
}

// atualiza estilo da nav e dos seus itens
function openTab(index) {
    // pega tab ativada no momento
    const activeTab = document.querySelector('.active-tab');
    if (activeTab != null) {
        activeTab.classList.remove('active-tab'); // retira seu estilo (nao esta mais ativa)
    }
    // faz a mesma coisa para o botao
    const activeButton = document.querySelector('.active-button');
    if (activeButton != null) {
        activeButton.classList.remove('active-button');
    }

    // atualiza tab e botao ativos
    document.querySelectorAll('.tabs section')[index].classList.add('active-tab');
    document.querySelectorAll('nav button')[index].classList.add('active-button');
}

window.onload = () => {
    // pega todos os botoes da nav 
    const buttons = document.querySelectorAll('nav button');
    buttons.forEach((button) => {
        // quando houver click no botão, chama a função changeTab
        button.onclick = changeTab;
    });
    openTab(0); // abre primeira tela do site, correspondente ao primeiro li da nav
}