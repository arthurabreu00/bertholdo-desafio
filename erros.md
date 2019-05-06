## Erros encontrados.

1. Dentro da tag `<form>` o atributo `action` indica para uma página inexistente e claro erro de escrita.
   Interpretei que a página estava referenciando a ela mesma, por tanto tal atributo não se faz necessário.

2. A tag `<form>` não há fechamento da mesma.

3. O Parâmetro passado para a função `get_address()` está indefinido;
   Originalmente o parâmetro estava descrito como `$cp`, sendo que a nomeclatura correta seria `$cep`.

4. Dentro da url passada para a busca de informações do CEP está `http://viacep.com.br/ws$cep/xml/` de acordo com a documentação oficial da API, o caminho correto é `http://viacep.com.br/ws/$cep/xml/`.

5. Na linha de retorno da rua, a váriavel que recebe o objeto está identificada como `$addres`, pela analise do código o nome correto deveria ser: `$address`, bem como a linha que identifca o bairro.

6. O Mesmo erro ocorre na linha de identificação do estado.

7. Na linha identificação/retorno do endereço há um erro de nomeclatura, de acordo com a documentação oficial da API, a variavel contida dentro do objeto é `$logradouro`, diferente da apontada originalmente pelo código `$logradoro`.
