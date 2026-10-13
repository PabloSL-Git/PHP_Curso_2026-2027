<?php
$estadios_futbol = array(
    "Barcelona"     => "Camp Nou",
    "Real Madrid"   => "Santiago Bernabeu",
    "Valencia"      => "Mestalla",
    "Real Sociedad" => "Anoeta"
);

// Mostrar en tabla
echo "<table border='1'>";
echo "<tr><th>Equipo</th><th>Estadio</th></tr>";
foreach ($estadios_futbol as $equipo => $estadio) {
    echo "<tr><td>$equipo</td><td>$estadio</td></tr>";
}
echo "</table>";

// Eliminar el estadio del Real Madrid
unset($estadios_futbol["Real Madrid"]);

// Mostrar de nuevo en lista numerada
echo "<ol>";
foreach ($estadios_futbol as $equipo => $estadio) {
    echo "<li>$equipo: $estadio</li>";
}
echo "</ol>";
