<?php
$animales = ["Lagartija", "Arana", "Perro", "Gato", "Raton"];
$numeros  = ["12", "34", "45", "52", "12"];
$otros    = ["Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34"];

$todos = [];
array_push($todos, ...$animales);
array_push($todos, ...$numeros);
array_push($todos, ...$otros);

echo "<pre>";
print_r($todos);
echo "</pre>";
