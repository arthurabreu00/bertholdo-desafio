const button = document.querySelector('.reset'); // Selecionando o botão de reset.

// Ao clicar no botão faça:
button.addEventListener('click', () => {
	const formInput = document.querySelector('.form-cep-input'); // Selecionando o campo de CEP.
	formInput.value = ''; // Limpando campo do CEP.
	formInput.focus(); // Focar no campo de CEP, para inserção dos próximos dados.
});
