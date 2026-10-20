<?php
$animales = ["Lagartija", "Arana", "Perro", "Gato", "Raton"];
$numeros  = ["12", "34", "45", "52", "12"];
$otros    = ["Sauce", "Pino", "Naranjo", "Chopo", "Perro", "34"];

$todos = [];
array_push($todos, ...$animales);
array_push($todos, ...$numeros);
array_push($todos, ...$otros);

$inverso = array_reverse($todos);

echo "<pre>";
print_r($inverso);
echo "</pre>";
