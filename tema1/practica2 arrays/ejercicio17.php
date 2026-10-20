<?php
$familias = [
    "Los Simpson" => [
        "padre" => "Homer",
        "madre" => "Marge",
        "hijos" => ["Bart", "Lisa", "Maggie"]
    ],
    "Los Griffin" => [
        "padre" => "Peter",
        "madre" => "Lois",
        "hijos" => ["Chris", "Meg", "Stewie"]
    ]
];

echo "<ul>";
foreach ($familias as $familia => $miembros) {
    echo "<li>$familia";
    echo "<ul>";
    echo "<li>Padre: " . $miembros["padre"] . "</li>";
    echo "<li>Madre: " . $miembros["madre"] . "</li>";
    echo "<li>Hijos: " . implode(", ", $miembros["hijos"]) . "</li>";
    echo "</ul>";
    echo "</li>";
}
echo "</ul>";
