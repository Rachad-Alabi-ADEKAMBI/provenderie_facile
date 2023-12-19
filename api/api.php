<?php
session_start();
//local
$pdo = new PDO('mysql:dbname=provenderie;host=localhost', 'root', '');
function getConnexion()
{
    return new PDO(
        'mysql:host=localhost; dbname=provenderie; charset=UTF8',
        'root',
        ''
    );
}

$error = ['error' => false];
$action = '';

if (isset($_GET['action'])) {
    $action = $_GET['action'];
}

function str_random($length)
{
    $alphabet =
        '0123456789qwertyuiopasdfghjklzxcvbnmQWERTYUIOPASDFGHJKLZXCVBNM';

    return substr(str_shuffle(str_repeat($alphabet, $length)), 0, $length);
}

// obtenir le titre de la page
function PageName()
{
    return substr(
        $_SERVER['SCRIPT_NAME'],
        strrpos($_SERVER['SCRIPT_NAME'], '/') + 1
    );
}

$current_page = PageName();

//controle des input
function verifyInput($inputContent)
{
    $inputContent = htmlspecialchars($inputContent);

    $inputContent = trim($inputContent);

    return $inputContent;
}

/*
function getHero()
{
    $pdo = getConnexion();
    $req = $pdo->prepare("SELECT * FROM
    images WHERE id = ?");
    $req->execute([1]);
    $datas = $req->fetchAll();
    $req->closeCursor();
    sendJSON($datas);
}
*/

function getSubjects()
{
    $pdo = getConnexion();
    $req = $pdo->prepare("SELECT * FROM
    subjects");
    $req->execute();
    $datas = $req->fetchAll();
    $req->closeCursor();
    sendJSON($datas);
}

function chooseSubject()
{
    if (!empty($_POST)) {
        $pdo = getConnexion();
        if (isset($_POST['subject'])) {
            $_SESSION['formula'] = [
                'subject' => verifyInput($_POST['subject']),
            ];

            header('Location: ../parts/choice2.php');
        } else {
             ?>
<script>
alert('Veuillez choisir un sujet');
location.replace('../parts/choice.php');
</script>

<?php
        }
    }
}

function chooseItem()
{
    if (!empty($_POST)) {
        $pdo = getConnexion();

        $subject = $_SESSION['formula']['subject'];

        if (verifyInput($_POST['item1'] != '')) {
            $item1 = verifyInput($_POST['item1']);
            $i = 1;

            $_SESSION['formula'] = [
                'subject' => $subject,
                'item1' => verifyInput($_POST['item1']),
                'total' => 1,
            ];
        }

        if (verifyInput($_POST['item2'] != '')) {
            $item2 = verifyInput($_POST['item2']);
            $_SESSION['formula'] = [
                'subject' => $subject,
                'item1' => verifyInput($_POST['item1']),
                'item2' => verifyInput($_POST['item2']),
                'total' => 2,
            ];
        }

        if (verifyInput($_POST['item3'] != '')) {
            $item3 = verifyInput($_POST['item3']);
            $i = 3;
            $_SESSION['formula'] = [
                'subject' => $subject,
                'item1' => verifyInput($_POST['item1']),
                'item2' => verifyInput($_POST['item2']),
                'item3' => verifyInput($_POST['item3']),
                'total' => 3,
            ];
        }

        if (verifyInput($_POST['item4'] != '')) {
            $item4 = verifyInput($_POST['item4']);
            $_SESSION['formula'] = [
                'subject' => $subject,
                'item1' => verifyInput($_POST['item1']),
                'item2' => verifyInput($_POST['item2']),
                'item3' => verifyInput($_POST['item3']),
                'item4' => verifyInput($_POST['item4']),
                'total' => 4,
            ];
            $i = 4;
        }

        if (verifyInput($_POST['item5'] != '')) {
            $item5 = verifyInput($_POST['item5']);
            $_SESSION['formula'] = [
                'subject' => $subject,
                'item1' => verifyInput($_POST['item1']),
                'item2' => verifyInput($_POST['item2']),
                'item3' => verifyInput($_POST['item3']),
                'item4' => verifyInput($_POST['item4']),
                'item5' => verifyInput($_POST['item5']),
                'total' => 5,
            ];
            $i = 5;
        }

        header('Location: ../parts/summary.php');
    } else {
         ?>
<script>
alert('Veuillez choisir une matière première');
location.replace('../parts/choice.php');
</script>

<?php
    }
}
function displaySummary()
{
    $subject = $_SESSION['formula']['subject'];
}

function calculate()
{
    //var_dump($_SESSION['formula']);
    $subject = $_SESSION['formula']['subject'];

    $pdo = new PDO('mysql:dbname=provenderie;host=localhost', 'root', '');

    $req = $pdo->prepare("SELECT * FROM
    subjects WHERE name = '$subject'");
    $req->execute();
    while ($datas = $req->fetch()) {
        $neededProtein1 = $datas['protein1'];
        $neededProtein2 = $datas['protein2'];

        $neededProtein = 0;
        $neededEnergy = 0;

        $neededEnergy1 = $datas['energy1'];
        $neededEnergy2 = $datas['energy2'];

        $level = $datas['level'];
    }

    //item1
    $item1 = $_SESSION['formula']['item1'];
    $req = $pdo->prepare("SELECT * FROM
    items WHERE name = '$item1'");
    $req->execute();
    while ($datas = $req->fetch()) {
        $protein1 = $datas['protein'];
        $energy1 = $datas['energy'];

        if ($level == 'demarrage') {
            $item1A = $datas['demarrage1'];
            $item1B = $datas['demarrage2'];
        } elseif ($level == 'croissance') {
            $item1A = $datas['croissance1'];
            $item1B = $datas['croissance2'];
        } elseif ($level == 'pondeuses') {
            $item1A = $datas['pondeuses1'];
            $item1B = $datas['pondeuses2'];
        } else {
            $item1A = $datas['reproducteurs1'];
            $item1B = $datas['reproducteurs2'];
        }
    }

    //item2
    $item2 = $_SESSION['formula']['item2'];
    $req = $pdo->prepare("SELECT * FROM
    items WHERE name = '$item2'");
    $req->execute();
    while ($datas = $req->fetch()) {
        $protein2 = $datas['protein'];
        $energy2 = $datas['energy'];

        if ($level == 'demarrage') {
            $item2A = $datas['demarrage1'];
            $item2B = $datas['demarrage2'];
        } elseif ($level == 'croissance') {
            $item2A = $datas['croissance1'];
            $item2B = $datas['croissance2'];
        } elseif ($level == 'pondeuses') {
            $item2A = $datas['pondeuses1'];
            $item2B = $datas['pondeuses2'];
        } else {
            $item2A = $datas['reproducteurs1'];
            $item2B = $datas['reproducteurs2'];
        }
    }

    $item1Qty = 0;
    $item2Qty = 0;

    // Assuming you have defined $item1, $item1A, $item1B, $item2, $item2A, $item2B somewhere before this code

    echo 'Ingrédient 1:  <br>';
    echo $item1 .
        " Quantité minimale: $item1A kg  et Quantité maximale:  $item1B. kg <br> <br>";

    echo 'Ingrédient 2:  <br>';
    echo $item2 .
        " Quantité minimale: $item2A kg  et Quantité maximale:  $item2B. kg <br><br>";

    // Function to calculate $item1Qty and $item2Qty
    function calculateQuantities($totalQuantity, $minQuantity, $maxQuantity)
    {
        // Ensure that minQuantity is not greater than maxQuantity
        $minQuantity = min($minQuantity, $maxQuantity);

        // Generate a random quantity between min and max
        $quantity = mt_rand($minQuantity * 100, $maxQuantity * 100) / 100;

        // Ensure quantity does not exceed total
        $quantity = min($quantity, $totalQuantity);

        // Round to the nearest integer
        $quantity = round($quantity);

        return $quantity;
    }

    // Total quantity you want ($item1Qty + $item2Qty) to be equal to
    $totalQuantity = 100;

    // Calculate quantity for item1
    $item1Qty = calculateQuantities($totalQuantity, $item1A, $item1B);

    // Calculate quantity for item2
    $maxItem2Qty = min($totalQuantity - $item1Qty, $item2B); // Ensure that $item2Qty does not exceed the remaining quantity
    $item2Qty = $totalQuantity - $item1Qty;

    echo 'Qté de item1: ' . $item1Qty . ' kg <br>';
    echo 'Qté de item2: ' . $item2Qty . ' kg  <br>';
}

function sendJSON($infos)
{
    header('Access-Control-Allow-Origin: *');
    header('Content-Type: application/json');
    echo json_encode($infos, JSON_UNESCAPED_UNICODE);
}
