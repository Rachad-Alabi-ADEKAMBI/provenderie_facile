<?php
include '../api/api.php';

//var_dump($_SESSION['formula']);
$i = $_SESSION['formula']['total'];
$item1 = $_SESSION['formula']['item1'];
$item2 = $_SESSION['formula']['item2'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Provenderie Facile - Récapitulatif</title>

    <?php include 'meta.php'; ?>
</head>

<body>
    <div class="content">
        <?php include 'header.php'; ?>

        <main class="main">
            <div class="list">
                <h1 class="subtitle">
                    Récapitulatif <br>
                    <strong class="strong">
                        Sujet:
                    </strong><?php echo $_SESSION['formula'][
                        'subject'
                    ]; ?> </span>
                </h1>

                <div class="list">
                    <h2>
                        Liste des matières premières
                    </h2>
                    <ul>
                        <li>
                            <?= $item1 ?>
                        </li>

                        <li>
                            <?= $item2 ?>
                        </li>
                    </ul>
                </div>

                <div class="actions">
                    <button class='btn btn-secondary'>
                        <a href="choice2.php">
                            Précédent
                        </a>
                    </button>

                    <button class='btn btn-success'>
                        <a href="http://127.0.0.1/provenderie/api/calculate">
                            Finaliser
                        </a>
                    </button>
                </div>
            </div>
        </main>


    </div>
    <script src="../public/js/script.js"></script>
</body>

</html>