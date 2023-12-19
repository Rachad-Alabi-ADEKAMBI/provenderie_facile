<?php
include '../api/api.php'; ?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Provenderie Facile - Choix 2/2</title>

    <?php include 'meta.php'; ?>
</head>

<body>
    <div class="content">
        <?php include 'header.php'; ?>

        <main class="main">
            <div class="list">
                <h1 class="subtitle">
                    Etape 2/2: <span>Choix des matières premières
                </h1> <br>

                <form action="http://127.0.0.1/provenderie/api/chooseItem" method="POST">
                    <div class="options">
                        <select class='select' name="item1" id="" required>
                            <option value="">Veuillez sélectionner</option>
                            <?php
                            $req = $pdo->prepare("SELECT * FROM
                            items");
                            $req->execute();

                            while ($datas = $req->fetch()) { ?>
                            <option value="<?php echo $datas[
                                'name'
                            ]; ?>"> <?php echo $datas['name']; ?> </option>
                            <?php }
                            ?>
                        </select> <br>

                        <select class='select' name="item2" id="">
                            <option value="">Veuillez sélectionner</option>
                            <?php
                            $req = $pdo->prepare("SELECT * FROM
                            items");
                            $req->execute();

                            while ($datas = $req->fetch()) { ?>
                            <option value="<?php echo $datas[
                                'name'
                            ]; ?>"> <?php echo $datas['name']; ?> </option>
                            <?php }
                            ?>
                        </select> <br>


                    </div>

                    <br>

                    <div class="actions">
                        <button class='btn btn-primary'>
                            <a href="choice.php">
                                Précédent
                            </a>
                        </button>

                        <button class='btn btn-success' type="submit">
                            Suivant
                        </button>
                    </div>
                </form>
            </div>
        </main>


    </div>
    <script src="../public/js/script.js"></script>
</body>

</html>