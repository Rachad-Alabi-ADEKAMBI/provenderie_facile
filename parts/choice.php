<?php
include '../api/api.php';
//$datas = 'http://127.0.0.1/provenderie/api/subjects';

$req = $pdo->prepare("SELECT * FROM
subjects");
$req->execute();
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <title>Provenderie Facile - Choix 1/2</title>

    <?php include 'meta.php'; ?>
</head>

<body>
    <div class="content">
        <?php include 'header.php'; ?>

        <main class="main">
            <div class="list">
                <h1 class="subtitle">
                    Etape 1/2: <span>Choix du sujet</span>
                </h1> <br>

                <form action="http://127.0.0.1/provenderie/api/chooseSubject" method="POST">
                    <select class='select' name="subject" id="" required>
                        <option value="">Veuillez sélectionner</option>
                        <?php while ($datas = $req->fetch()) { ?>
                        <option value="<?php echo $datas[
                            'name'
                        ]; ?>"> <?php echo $datas['name']; ?> </option>
                        <?php } ?>
                    </select> <br> <br> <br>

                    <button type="submit" class='btn btn-success'>
                        Suivant
                    </button>
                </form>
            </div>
        </main>


    </div>
    <script src="../public/js/script.js"></script>
</body>

</html>