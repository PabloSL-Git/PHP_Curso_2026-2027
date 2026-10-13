<?php
$numeros = array(3, 2, 8, 123, 5, 1);

sort($numeros); // de menor a mayor

echo "<table border='1'>";
echo "<tr><th>Indice</th><th>Valor</th></tr>";
foreach ($numeros as $indice => $valor) {
    echo "<tr><td>$indice</td><td>$valor</td></tr>";
}
echo "</table>";
