<?php

function calculateItems($numItems, $itemDetails, $totalQuantity)
{
    $itemQtyArray = [];

    for ($i = 0; $i < $numItems; $i++) {
        $item = $itemDetails[$i]['item'];
        $minQuantity = $itemDetails[$i]['min'];
        $maxQuantity = $itemDetails[$i]['max'];

        echo "Ingrédient $i: <br>";
        echo "$item Quantité minimale: $minQuantity kg  et Quantité maximale: $maxQuantity kg <br><br>";

        $itemQty = calculateQuantity(
            $totalQuantity,
            $minQuantity,
            $maxQuantity
        );
        $itemQtyArray[] = $itemQty;

        echo "Qté de $item: $itemQty kg <br>";
    }

    return $itemQtyArray;
}

function calculateQuantity($totalQuantity, $minQuantity, $maxQuantity)
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

// Define the number of items, their details, and the total quantity
$numItems = 2; // Change this as needed
$itemDetails = [
    ['item' => 'item1', 'min' => $item1A, 'max' => $item1B],
    ['item' => 'item2', 'min' => $item2A, 'max' => $item2B],
    // Add more items as needed
];

$totalQuantity = 100; // Change this as needed

// Calculate quantities for all items
$itemQtyArray = calculateItems($numItems, $itemDetails, $totalQuantity);
