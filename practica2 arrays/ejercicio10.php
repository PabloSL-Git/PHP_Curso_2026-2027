<?php
$numeros = [1, 2, 3, 4, 5, 6, 7, 8, 9, 10];

// Media de los valores que estan en posiciones pares (indices 0, 2, 4, 6, 8)
$suma = 0;
$cantidad = 0;
for ($i = 0; $i < count($numeros); $i++) {
    if ($i % 2 == 0) {
        $suma += $numeros[$i];
        $cantidad++;
    }
}
$media = $suma / $cantidad;
echo "La media de los valores en posiciones pares es: $media" . "<br>";

// Numeros impares
echo "Numeros impares:" . "<br>";
foreach ($numeros as $numero) {
    if ($numero % 2 != 0) {
        echo $numero . "<br>";
    }
}
