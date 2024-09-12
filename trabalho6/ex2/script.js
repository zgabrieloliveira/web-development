const button = document.querySelector('button');
button.onclick = function() {
    const input = document.querySelector('input');
    const output = document.querySelector('p'); 
    output.textContent = `Obrigado, ${input.value}!`;
}