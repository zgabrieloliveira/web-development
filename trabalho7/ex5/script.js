// aciona window.onload quando a página termina de carregar
window.onload = () => {
    // pega elemento html do modal atraves da sua classe
    const modal = document.querySelector('.modal');
    // pega botão de fechar modal atraves de seletor de filho da classe modal
    const modalCloseButton = document.querySelector('.modal-content button');

    // modal fecha se apertar esc com ele aberto
    document.onkeyup = function (event) {
        // antes de atribuir, verifica se modal está aberto (display block)
        if (event.key === "Escape" && modal.style.display === 'block') {
            modal.style.display = 'none';
        }
    };

    // quando clicar no botao de fechar modal, 
    // muda display para none, parando de ocupar espaço na tela
    modalCloseButton.onclick = () => {
        modal.style.display = 'none';
    }
    // quando clicar no botao de abrir modal,
    // muda display para block, entao o modal vai aparecer por cima da pagina atual
    const modalOpenButton = document.getElementById('open-modal-button');

    modalOpenButton.onclick = () => { 
        modal.style.display = 'block';
    }

}