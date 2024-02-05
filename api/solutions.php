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

//item3
$item3 = $_SESSION['formula']['item3'];
$req = $pdo->prepare("SELECT * FROM
items WHERE name = '$item3'");
$req->execute();
while ($datas = $req->fetch()) {
$protein2 = $datas['protein'];
$energy2 = $datas['energy'];

if ($level == 'demarrage') {
$item3A = $datas['demarrage1'];
$item3B = $datas['demarrage2'];
} elseif ($level == 'croissance') {
$item3A = $datas['croissance1'];
$item3B = $datas['croissance2'];
} elseif ($level == 'pondeuses') {
$item3A = $datas['pondeuses1'];
$item3B = $datas['pondeuses2'];
} else {
$item3A = $datas['reproducteurs1'];
$item3B = $datas['reproducteurs2'];
}
}

$item1Qty = 0;
$item2Qty = 0;
$item3Qty = 0;

// Assuming you have defined $item1, $item1A, $item1B, $item2, $item2A, $item2B, $item3, $item3A, $item3B somewhere
before this code

echo 'Ingrédient 1: <br>';
echo $item1 .
" Quantité minimale: $item1A kg et Quantité maximale: $item1B. kg <br> <br>";

echo 'Ingrédient 2: <br>';
echo $item2 .
" Quantité minimale: $item2A kg et Quantité maximale: $item2B. kg <br><br>";

echo 'Ingrédient 3: <br>';
echo $item3 .
" Quantité minimale: $item3A kg et Quantité maximale: $item3B. kg <br><br>";

// Function to calculate random quantity within a range
function calculateRandomQuantity(
$minQuantity,
$maxQuantity,
$remainingQuantity
) {
// Ensure that minQuantity is not greater than maxQuantity
$minQuantity = min($minQuantity, $maxQuantity);

// Generate a random quantity between min and max
$quantity = mt_rand($minQuantity * 100, $maxQuantity * 100) / 100;

// Ensure quantity does not exceed remaining quantity
$quantity = min($quantity, $remainingQuantity);

// Round to the nearest integer
$quantity = round($quantity);

return $quantity;
}

// Total quantity you want ($item1Qty + $item2Qty + $item3Qty) to be equal to
$totalQuantity = 100;

// Calculate quantity for item1 within the specified range
$item1Qty = calculateRandomQuantity($item1A, $item1B, $totalQuantity);

// Calculate quantity for item2 within the specified range
$item2Qty = calculateRandomQuantity(
$item2A,
$item2B,
$totalQuantity - $item1Qty
);

// Calculate quantity for item3 within the specified range
$item3Qty = $totalQuantity - $item1Qty - $item2Qty;

echo 'Quantité de item1: ' . $item1Qty . ' kg <br>';
echo 'Quantité de item2: ' . $item2Qty . ' kg <br>';
echo 'Quantité de item3: ' . $item3Qty . ' kg <br>';
}