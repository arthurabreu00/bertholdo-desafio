<?php
// Classe com objetivo de buscar diversas informações sobre uma localidade em territorio nacional, com base no CEP.


class Address
{
    /*
      - Observações: 

     * Para evitar extrapolar algum critério, não apliquei os campos faltantes, como Cidade/Localidade 
       e Quaisquer outras informações que a API retorne.

     * Novamente para seguir o cenário imposto, acredito que o ideal para está classe seria ter um método constructor,
       para substituir o atual método get_adress().
    */

    public function get_address($cep)
    {

        // Validando se o CEP está correto,se não, retorne um erro.
        if (!$this->validation_cep($cep)) {
            return false;
        }

        // Função para buscar os dados via API baseado no CEP informado.
        $cep = preg_replace("/[^0-9]/", "", $cep); // Limpeza para deixar apenas números.
        // Caso contrário mostre normalmente.

        $url = "http://viacep.com.br/ws/$cep/xml/"; // Chamada da api de acordo com a documentação.
        $xml = simplexml_load_file($url); // Capturando resposta obtida da API via XML.

        return  $xml;
    }

    public function write_address($cep, $street)
    {
        // Função de resumo/Inicialização de escrita dos dados retornados da API.

        // Se o cep for inválido faça, escreva uma mensagem de erro.
        $this->write_cep($cep); // Escrevendo o 1º Campo : O cep informado na tela.

        if (!$this->get_address($cep)) {
            $this->write_erro('CEP inválido'); // Escrevendo caso ocorrer um erro.
        } else {

            $this->write_street($street); // Escrevendo o 2º Campo : A Rua na tela.
            $this->write_district($street); // Escrevendo o 3º Campo : O Bairro informado na tela.
            $this->write_country($street); // Escrevendo o 4º Campo : O Estado informado na tela.
        }
    }

    /* 
        PS: As função as baixos são muito semelhantes, 
        decidir fazer desta forma, para evitar maior complexidade do código.
        E como se trata-se de uma pequena classe para avaliação, 
        acredito que desta maneira fique mais claro.
    */


    private function validation_cep($cep)
    {
        $findWords = $this->findWords($cep);
        if ($findWords) return false;  // Se o CEP conter letras, ele é inválido.

        // Regex para identificar se trata-se de um CEP.
        $valRegex = preg_match('/^[0-9]{5,5}([- ]?[0-9]{3,3})?$/', $cep);
        // 5 Valores númericos, com barra opcional e posteriosmtente mais 3 números.

        // Se encontrar algo: CEP Válido.
        if ($valRegex) return true;

        // Se não, CEP Inválido.
        return false;
    }

    private function findWords($cep)
    {
        // Verificando via regex se CEP contêm letras.
        return preg_match('/\w[À-ü]/', $cep);
    }

    private function write_erro($erro)
    {
        // Função para escrever na interface, um ERRO informado.

        // Abaixo descrito um HTML, necessário para a formatação dentro da aplicação.

        echo '<div class="resultadoCEP">
        <div class="titleCEP">
            <p> Ocorreu um erro:</p>
        </div>
        <div class="result">
            <p class="resultFinal text-danger">' . $erro . '</p>
        </div>
        </div>';
    }


    private function write_cep($cep)
    {
        // Função para escrever na interface, o CEP informado.

        // Abaixo descrito um HTML, necessário para a formatação dentro da aplicação.
        echo '<div class="resultadoCEP">
        <div class="titleCEP">
            <p> CEP Informado:</p>
        </div>
        <div class="result">
            <p class="resultFinal">' . $cep . '</p>
        </div>
        </div>';
    }

    private function write_street($street)
    {
        // Função para escrever na interface, a Rua obtida.

        // Abaixo descrito um HTML, necessário para a formatação dentro da aplicação.
        echo '<div class="resultadoCEP">
        <div class="titleCEP">
            <p> Rua: </p>
        </div>
        <div class="result">
            <p class="resultFinal">' . $street->logradouro . '</p>
        </div>
        </div>';
    }

    private function write_district($street)
    {
        // Função para escrever na interface, o bairro obtido.

        // Abaixo descrito um HTML, necessário para a formatação dentro da aplicação.
        echo '<div class="resultadoCEP">
        <div class="titleCEP">
            <p> Bairro:</p>
        </div>
        <div class="result">
            <p class="resultFinal">' . $street->bairro . '</p>
        </div>
        </div>';
    }

    private function write_country($street)
    {
        // Função para escrever na interface, o estado obtido.

        // Abaixo descrito um HTML, necessário para a formatação dentro da aplicação.
        echo '<div class="resultadoCEP">
        <div class="titleCEP">
            <p> Estado:</p>
        </div>
        <div class="result">
            <p class="resultFinal">' . $street->uf . '</p>
        </div>
        </div>';
    }
}