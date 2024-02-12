<?php
session_start(); ?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Provenderie Facile - Accueil</title>

    <link rel="stylesheet" href="http://127.0.0.1/provenderie/public/css/main.css">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

</head>

<body>
    <div class="content">
        <?php include 'parts/header.php'; ?>

        <main class="main">
            <div class="list">
                <ul>
                    <li>
                        <button class="btn btn-primary" onclick="newFormula()">
                            Nouvelle formule
                        </button>
                    </li>


                    <li>
                        <button class="btn btn-primary" onclick="comingSoon()">
                            Mes formules
                        </button>
                    </li>
                </ul>
            </div>
        </main>


    </div>
    <script src="public/js/script.js"></script>
</body>

</html>