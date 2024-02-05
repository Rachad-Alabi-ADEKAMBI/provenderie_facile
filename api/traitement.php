<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $item1 = $_POST["item1"];
    $item2 = $_POST["item2"];
    $item3 = $_POST["item3"];

    // Exécuter le script Python avec les données du formulaire
    $command = "python3 script.py " . escapeshellarg($item1) . " " . escapeshellarg($item2) . " " . escapeshellarg($item3);
    $output = shell_exec($command);

    // Afficher la sortie du script Python
    echo $output;
}
?>