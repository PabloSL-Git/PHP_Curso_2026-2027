<?php
$ciudades = [
    "MD"  => "Madrid",
    "BCN" => "Barcelona",
    "LDN" => "Londres",
    "NY"  => "New York",
    "LA"  => "Los Angeles",
    "CHG" => "Chicago"
];

foreach ($ciudades as $indice => $ciudad) {
    echo "El indice del array que contiene como valor $ciudad es $indice." . "<br>";
}
