<?php

// Given values
$item1A = 10;
$item1B = 50;
$item2A = 20;
$item2B = 60;
$item3A = 30;
$item3B = 70;
$item4A = 40;
$item4B = 80;

$protein1 = 5;
$protein2 = 7;
$protein3 = 10;
$protein4 = 8;

$energy1 = 2;
$energy2 = 3;
$energy3 = 5;
$energy4 = 4;

$neededProtein1 = 18;
$neededProtein2 = 20;

$neededEnergy1 = 200;
$neededEnergy2 = 300;

// Loop until valid values are found
while (true) {
    // Generate random values within the specified ranges
    $item1 = rand($item1A, $item1B);
    $item2 = rand($item2A, $item2B);
    $item3 = rand($item3A, $item3B);
    $item4 = rand($item4A, $item4B);

    // Calculate neededProtein and neededEnergy
    $neededProtein =
        ($item1 * $protein1) / 100 +
        ($item2 * $protein2) / 100 +
        ($item3 * $protein3) / 100 +
        ($item4 * $protein4) / 100;
    $neededEnergy =
        ($item1 * $energy1) / 100 +
        ($item2 * $energy2) / 100 +
        ($item3 * $energy3) / 100 +
        ($item4 * $energy4) / 100;

    // Check if the values are within the specified ranges
    if (
        $neededProtein >= $neededProtein1 &&
        $neededProtein <= $neededProtein2 &&
        $neededEnergy >= $neededEnergy1 &&
        $neededEnergy <= $neededEnergy2
    ) {
        break;
    }
}

// Output the results
echo "item1: $item1, item2: $item2, item3: $item3, item4: $item4\n";
echo "neededProtein: $neededProtein\n";
echo "neededEnergy: $neededEnergy\n";
?>




//solution2
<?php
// Given values
$protein1 = 10; // Replace with actual values
$protein2 = 15;
$protein3 = 8;
$protein4 = 12;

$energy1 = 5;
$energy2 = 10;
$energy3 = 7;
$energy4 = 15;

$item1A = 10;
$item1B = 30;
$item2A = 20;
$item2B = 40;
$item3A = 5;
$item3B = 25;
$item4A = 15;
$item4B = 35;

$neededProtein1 = 18;
$neededProtein2 = 20;

$neededEnergy1 = 200;
$neededEnergy2 = 250;

// Randomly generate values for $item1, $item2, $item3, and $item4
$item1 = rand($item1A, $item1B);
$item2 = rand($item2A, $item2B);
$item3 = rand($item3A, $item3B);
$item4 = rand($item4A, $item4B);

// Calculate the total and needed values
$total = $item1 + $item2 + $item3 + $item4;
$neededProtein =
    ($item1 * $protein1) / 100 +
    ($item2 * $protein2) / 100 +
    ($item3 * $protein3) / 100 +
    ($item4 * $protein4) / 100;
$neededEnergy =
    ($item1 * $energy1) / 100 +
    ($item2 * $energy2) / 100 +
    ($item3 * $energy3) / 100 +
    ($item4 * $energy4) / 100;

// Check if the generated values meet the constraints
while (
    $neededProtein < $neededProtein1 ||
    $neededProtein > $neededProtein2 ||
    $neededEnergy < $neededEnergy1 ||
    $neededEnergy > $neededEnergy2
) {
    $item1 = rand($item1A, $item1B);
    $item2 = rand($item2A, $item2B);
    $item3 = rand($item3A, $item3B);
    $item4 = rand($item4A, $item4B);

    $total = $item1 + $item2 + $item3 + $item4;
    $neededProtein =
        ($item1 * $protein1) / 100 +
        ($item2 * $protein2) / 100 +
        ($item3 * $protein3) / 100 +
        ($item4 * $protein4) / 100;
    $neededEnergy =
        ($item1 * $energy1) / 100 +
        ($item2 * $energy2) / 100 +
        ($item3 * $energy3) / 100 +
        ($item4 * $energy4) / 100;
}

// Output the results
echo "Generated values:\n";
echo "\$item1: $item1\n";
echo "\$item2: $item2\n";
echo "\$item3: $item3\n";
echo "\$item4: $item4\n";
echo "Total: $total\n";
echo "Needed Protein: $neededProtein\n";
echo "Needed Energy: $neededEnergy\n";


?>
