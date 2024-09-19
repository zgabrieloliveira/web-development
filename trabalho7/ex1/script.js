const subtitles = document.querySelectorAll('h2'); // pega todos os h2 da página

// percorre os elementos obtidos pela query anterior
subtitles.forEach((subtitle) => {
    // click 1x esconde o conteúdo do elemento subsequente ao h2
    subtitle.addEventListener('click', function() {
        subtitle.nextElementSibling.style.display = 'none';
    });
    
    // click 2x faz o conteúdo reaparecer
    subtitle.addEventListener('dblclick', function() {
        subtitle.nextElementSibling.style.display = 'block';
    });
});
