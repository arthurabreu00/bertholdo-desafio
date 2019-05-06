<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <!--Title -->
    <title> MEU CEP </title>
    <!-- Meta -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <!-- Css Required - Font and Icons -->
    <link href="https://fonts.googleapis.com/css?family=Roboto" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.2.0/css/all.css"
        integrity="sha384-hWVjflwFxL6sNzntih27bfxkr27PmbbK/iSvJ+a4+0owXq79v+lsFkW54bOGbiDQ" crossorigin="anonymous">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="style.css">
</head>

<body>
    <div id="root">
        <!-- Header -->
        <header class="content">
            <div class="title">
                <!-- Icon -->
                <div class="decalc">
                    <i class="fas fa-map-marked-alt"></i>
                </div>

                <!-- Title and Subtitle -->
                <div class="text_one">
                    <h4 class="read"> Localizador com base no CEP </h4>
                    <span>Digite seu CEP</span>
                </div>
            </div>
        </header>
        <!-- Form -->
        <form class="form-cep" method="POST">
            <div class="form-group">
                <label for="cep"> CEP </label>
                <!-- Main Input -->
                <input type="text" class="form-cep-input" name="cep" id="cep" placeholder="Digite seu cep">
                <!-- Submit Button -->
                <button type="submit" class="form-cep-btn"> <i class="fa fa-arrow-right" aria-hidden="true"></i>
            </div>
        </form>
        <!-- Main classe -->
        <main class="display">
            <?php

            include_once('Address.php'); // Incluindo uma única vez o arquivo que contém a classe Adress.

            // Se a váriavel não estiver vazia e existir faça: 
            if (!empty($_POST['cep'])) {
                $cep = $_POST['cep']; // Recebendo via método post.
                $address = new Address(); // Declarando a classe Adress.
                $street = $address->get_address($cep); // Retorno do método get_adress, informações puxadas da API.
                $address->write_address($cep, $street); // Escrevendo na tela as informações obtidas.
            }

            ?>

        </main>

        <!-- Reset Button -->
        <section class="painel">
            <div class="button">
                <button class="btn reset">
                    Nova Consulta
                </button>
            </div>
        </section>

    </div>
    </div>

    <script src="reset.js"></script>
</body>

</html>