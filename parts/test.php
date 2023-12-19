<?php
// Given values
$neededEnergy = 100; // Replace with the actual value
$neededProtein = 50; // Replace with the actual value

$protein1 = 10; // Replace with the actual value
$protein2 = 20; // Replace with the actual value
$protein3 = 15; // Replace with the actual value
$protein4 = 25; // Replace with the actual value

$energy1 = 5; // Replace with the actual value
$energy2 = 15; // Replace with the actual value
$energy3 = 10; // Replace with the actual value
$energy4 = 20; // Replace with the actual value

// Define the range for each valueItem
$valueItem1A = 0;
$valueItem1B = 50;

$valueItem2A = 10;
$valueItem2B = 60;

$valueItem3A = 20;
$valueItem3B = 70;

$valueItem4A = 5;
$valueItem4B = 55;

// Increment step size
$incrementStep = 1;

// Loop to calculate values within the specified range
for (
    $valueItem1 = $valueItem1A;
    $valueItem1 <= $valueItem1B;
    $valueItem1 += $incrementStep
) {
    for (
        $valueItem2 = $valueItem2A;
        $valueItem2 <= $valueItem2B;
        $valueItem2 += $incrementStep
    ) {
        for (
            $valueItem3 = $valueItem3A;
            $valueItem3 <= $valueItem3B;
            $valueItem3 += $incrementStep
        ) {
            for (
                $valueItem4 = $valueItem4A;
                $valueItem4 <= $valueItem4B;
                $valueItem4 += $incrementStep
            ) {
                // Check if the equation is satisfied
                if (
                    100 ==
                    $valueItem1 + $valueItem2 + $valueItem3 + $valueItem4
                ) {
                    // Calculate neededProtein and neededEnergy
                    $calculatedProtein =
                        ($valueItem1 * $protein1) / 100 +
                        ($valueItem2 * $protein2) / 100 +
                        ($valueItem3 * $protein3) / 100 +
                        ($valueItem4 * $protein4) / 100;

                    $calculatedEnergy =
                        ($valueItem1 * $energy1) / 100 +
                        ($valueItem2 * $energy2) / 100 +
                        ($valueItem3 * $energy3) / 100 +
                        ($valueItem4 * $energy4) / 100;

                    // Check if the calculated values match the given values
                    if (
                        $calculatedProtein == $neededProtein &&
                        $calculatedEnergy == $neededEnergy
                    ) {
                        // Display the values and exit the loop
                        echo "Valid values found:\n";
                        echo "\$valueItem1: $valueItem1\n";
                        echo "\$valueItem2: $valueItem2\n";
                        echo "\$valueItem3: $valueItem3\n";
                        echo "\$valueItem4: $valueItem4\n";
                        exit();
                    }
                }
            }
        }
    }
}

// If no valid values are found
echo "Unable to find valid values within the specified range.\n";
?>
