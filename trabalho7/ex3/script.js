const button = document.querySelector("button");
const input = document.querySelector("input");
const errorMessage = document.getElementById("error-message");

function addItem() {
  // se o input estiver vazio, exibe a mensagem de erro e sai da função
  if (input.value === "") {
    errorMessage.style.display = "block";
    return;
  }
  // caso contrario, esconde mensagem de erro novamente se for necessario
  errorMessage.style.display = "none";
  // cria um novo li onde o span vai conter o texto e havera um botão de delete
  const newItem = document.createElement("li");
  const interestText = document.createElement("span");
  const deleteButton = document.createElement("button");
  newItem.textContent = input.value;
  deleteButton.textContent = "✖️";

  newItem.appendChild(interestText);
  newItem.appendChild(deleteButton);
  const ul = document.querySelector("ul");
  ul.appendChild(newItem);

  // quando clicar no botão, o li é removido
  deleteButton.onclick = () => {
    newItem.remove();
  };

  input.value = ""; // limpa o input
}

// apertar enter dispara a função
document.onkeyup = function (event) {
  if (event.key === "Enter") {
    addItem();
  }
};

button.onclick = addItem; // clicar no botão dispara a função
