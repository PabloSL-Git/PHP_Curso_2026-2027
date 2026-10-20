<?php
$deportes = ["futbol", "baloncesto", "natacion", "tenis"];

for ($i = 0; $i < count($deportes); $i++) {
    echo $deportes[$i] . "<br>";
}

echo "<br>Total de valores: " . count($deportes) . "<br>";

reset($deportes);
echo "Primer elemento (valor actual): " . current($deportes) . "<br>";

next($deportes);
echo "Avanzo una posicion: " . current($deportes) . "<br>";

end($deportes);
echo "Ultima posicion: " . current($deportes) . "<br>";

prev($deportes);
echo "Retrocedo una posicion: " . current($deportes) . "<br>";
