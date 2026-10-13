<?php
$amigos = [
    "Madrid" => [
        "nombre"   => "Pedro",
        "edad"     => 32,
        "telefono" => "91-999.99.99"
    ],
    "Barcelona" => [
        "nombre"   => "Susana",
        "edad"     => 34,
        "telefono" => "93-000.00.00"
    ],
    "Toledo" => [
        "nombre"   => "Sonia",
        "edad"     => 42,
        "telefono" => "925-09.09.09"
    ]
];

foreach ($amigos as $ciudad => $amigo) {
    $partes = [];
    foreach ($amigo as $campo => $valor) {
        $partes[] = "$campo $valor";
    }
    echo "En $ciudad: " . implode(", ", $partes) . "<br>";
}
