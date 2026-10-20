<?php
$persona = [
    "nombre" => "Pedro Torres",
    "direccion" => "C/Mayor, 37",
    "telefono" => "123456789"
];

foreach ($persona as $campo => $valor) {
    echo "$campo: $valor" . "<br>";
}