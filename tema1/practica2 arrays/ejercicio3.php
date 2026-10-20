<?php
$peliculas = [
    "enero" => 9,
    "febrero" => 12,
    "marzo" => 0,
    "abril" => 17
];

foreach ($peliculas as $mes => $numero) {
    if ($numero > 0) {
        echo "En $mes se han visto $numero películas" . "<br>";
    }
}