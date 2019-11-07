const button = document.querySelector('.reset'); // Selecionando o botão de reset.

// Ao clicar no botão faça:
button.addEventListener('click', () => {
	document.querySelector('.form-cep-input').reset();
});
