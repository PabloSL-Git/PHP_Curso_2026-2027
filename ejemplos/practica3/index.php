<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Practica 3</title>
</head>
<body>
    <h1>Teoria Arrays - Strings</h1>
    <?php 
        $notas[0] = 1;
        $notas[1] = 67;
        $notas[2] = 32;

        if (in_array(67, $notas)) {
            echo "<p> EL numero 67 esta en array notas </p>";
        }
        else {
            echo "<p> El numero 67 no esta en array notas </p>";
        }
        echo "<p> El array notas tiene " . count($notas) .  " elementos";

        // $valores[] = 18;
        // $valores[] = true;
        // $valores[] = "hola";
        // $valores["salario"]=3000;
        
        $valores = Array(18,true,"Una cadena","salario" => 3000,7 => 78,90,"fecha" => "23/09/2026");

        // $paises["España"]["Malaga"] = 600000;
        // $paises["España"]["Granada"] = 500000;
        // $paises["España"]["Almeria"] = 400000;
        // $paises["Francia"]["Paris"] = 600000;
        // $paises["Francia"]["Lyon"] = 500000;
        // $paises["Francia"]["Marsella"] = 400000;


        echo "<ul>";
        foreach($valores as $indice => $valor){
            echo "<li>Indice: " . $indice . " Valor:" . $valor . "</li>";
        }
        echo "</ul>";

        $paises=array("España" => array("Malaga" => 900000,"Granada" => 800000, "Almeria" => 500000),"Francia" => array("Paris" => 600000,"Lyon" => 500000, "Marsella" => 400000));

        echo "<h3> Habiteantes de las principales ciudades de europe </h3>";
        echo "<ol>";
        foreach($paises as $pais => $ciudades){
            echo "<li>";
                echo $pais;
                    echo "<ul>";
                        foreach ($ciudades as $ciudad => $habitantes){
                            echo "<li>" . $ciudad . ":" . $habitantes . "</li>";
                        }
                    echo "</ul>";
            echo "</li>";
        }
        echo "</ol>";

        $capital = array("Castilla y leon" => "Valladolid", "Asturias" => "Oviedo", "Aragon" => "Zaragoza");
        end($capital);
        while(current($capital)){
            echo "<p><strong>" . next($capital) . "</strong></p>";
        }
?>
</body>
</html>