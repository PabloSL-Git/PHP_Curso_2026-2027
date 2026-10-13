<?php
$nombres = ["Pedro", "Ismael", "Sonia", "Clara", "Susana", "Alfonso", "Teresa"];

echo "Numero de elementos: " . count($nombres) . "<br>";

echo "<ul>";
foreach ($nombres as $nombre) {
    echo "<li>$nombre</li>";
}
echo "</ul>";
