<?php
$lenguajes_cliente = [
    "c1" => "HTML",
    "c2" => "CSS",
    "c3" => "JavaScript"
];

$lenguajes_servidor = [
    "s1" => "PHP",
    "s2" => "Java",
    "s3" => "Python"
];

$lenguajes = array_merge($lenguajes_cliente, $lenguajes_servidor);

echo "<table border='1'>";
echo "<tr><th>indice</th><th>Lenguaje</th></tr>";
foreach ($lenguajes as $indice => $lenguaje) {
    echo "<tr><td>$indice</td><td>$lenguaje</td></tr>";
}
echo "</table>";
