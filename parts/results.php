<!DOCTYPE html>
<html lang="en">

<head>
    <title>Provenderie Facile - Résultats</title>

    <?php include 'meta.php'; ?>
</head>

<body>
    <div class="content">
        <?php include 'header.php'; ?>

        <main class="main">
            <div class="list">
                <h1 class="subtitle">
                    Résultats
                </h1>

                <p class="text">
                    Voici 1/10 possibilité de formules de provendes <br> possibles
                    pour le sujet <span>Poussin</span>
                </p>

                <br>



                <h3>
                    Formule <span>1</span>
                </h3>

                <ul>
                    <li class="item">
                        Matière 1 <span class="item__quantity">
                            46 kg
                        </span>

                        <span class="item__mat">
                            MAT: 4,32
                        </span>

                        <span class="item__energie">
                            Energie: 1632
                        </span>
                    </li>

                    <li class="item">
                        Matière 1 <span class="item__quantity">
                            46 kg
                        </span>

                        <span class="item__mat">
                            MAT: 4,32
                        </span>

                        <span class="item__energie">
                            Energie: 1632
                        </span>
                    </li>

                    <li class="item">
                        Total matières <strong class="item__quantity">
                            100 kg
                        </strong>

                        <span class="item__mat">
                            MAT: 19,32
                        </span>

                        <span class="item__energie">
                            Energie: 2700
                        </span>
                    </li>

                </ul>

                <p class="total">
                    Pour 100kg

                    <span class="total__mat">
                        17.76
                    </span>

                    <span class="total__energie">
                        2 600
                    </span>
                </p> <br>

                <div class="actions">
                    <button class='btn btn-secondary' onclick="print()">
                        Imprimer
                    </button>

                    <button class='btn btn-tertiary' onclick="comingSoon()">
                        Enregistrer
                    </button>

                    <button type="submit" class='btn btn-primary' onclick="comingSoon()">
                        Formule suivante
                    </button>
                </div>


            </div>
        </main>


    </div>
    <script src="../public/js/script.js"></script>
</body>

</html>