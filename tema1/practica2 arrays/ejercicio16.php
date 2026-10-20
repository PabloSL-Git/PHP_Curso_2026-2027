<?php
$datos = [5 => 1, 12 => 2, 13 => 56, "x" => 42];

echo "Contenido inicial:" . "<br>";
foreach ($datos as $indice => $valor) {
    echo "$indice => $valor" . "<br>";
}

echo "Numero de elementos: " . count($datos) . "<br><br>";

// Borrar el elemento de la posicion 5
unset($datos[5]);

echo "Contenido despues de borrar la posicion 5:" . "<br>";
foreach ($datos as $indice => $valor) {
    echo "$indice => $valor" . "<br>";
}

// Eliminar el array
unset($datos);
echo "<br>" . "El array ha sido eliminado.";
