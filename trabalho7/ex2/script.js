const images = document.querySelectorAll('td img'); // pega imagens da galeria
// salva o valor original de boxShadow (igual para todas as imagens)
const originalBoxShadow = images[0].style.boxShadow

// quando o usuario passar o mouse 
// por cima de cada imagem, a sombra dela fica vermelha
// e volta ao normal quando o mouse sair
images.forEach((image) => {

    image.onmouseover = () => {
        image.style.boxShadow = '3px 3px 4px red';
    }
    
    image.onmouseout = () => {
        image.style.boxShadow = originalBoxShadow;
    }

});