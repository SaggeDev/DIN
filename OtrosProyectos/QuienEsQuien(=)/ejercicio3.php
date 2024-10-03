<?php
// Datos de conexión a la base de datos
$servername = "localhost";
$username = "AlexOlle";
$password = "AlexOlle";
$dbname = "ejerciciosdin";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}


// Ejercicio 1 con 2 consultas:


$sql = "SELECT Nombre, BandaFavorita FROM ejercicio1 WHERE SoyMasDe='Playa'";

$countSql = "SELECT COUNT(SoyMasDe) AS totalPlaya FROM ejercicio1 WHERE SoyMasDe='Playa'";

$result = $conn->query($sql);
$countResult = $conn->query($countSql);

$tabla = "";  

if ($result->num_rows > 0) {
    $id = 0;
    $tabla = "<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>Banda Favorita</th>
    </tr>";
    
    while ($row = $result->fetch_assoc()) {
        $id++;
        $tabla .= "
        <tr>
            <td>" . $id . "</td>
            <td>" . $row["Nombre"] . "</td>
            <td>" . $row["BandaFavorita"] . "</td>
        </tr>";
    }
    $tabla .= "</table>";  // Cerrar la tabla después de agregar todas las filas
    
    // Obtener el resultado del count 
        $rowCount = $countResult->fetch_assoc();
        $resultadoTotal = "<p>El número de gente de playa es " . $rowCount['totalPlaya']."</p>";
    
} else {
    $tabla = "No hay resultados.";
}




// Alternativa 2:


$sql2 = "SELECT Nombre, SoyMasDe FROM ejercicio1 WHERE SoyMasDe='Playa'";
$result2 = $conn->query($sql2);

$tabla2 = "";  

if ($result->num_rows > 0) {
    $id = 0;
    $tabla2 = "<table>
    <tr>
        <th>Id</th>
        <th>Nombre</th>
        <th>SoyMasDe</th>
    </tr>";
    
    // Contador de playeros
    $playeros = 0;

    while ($row2 = $result2->fetch_assoc()) {
        $id++;
        $tabla2 .= "
        <tr>
            <td>" . $id . "</td>
            <td>" . $row2["Nombre"] . "</td>
            <td>" . $row2["SoyMasDe"] . "</td>
        </tr>";
        
        // Sumatorio playeros
        $playeros++;
    }
    $tabla2 .= "</table>"; 
    $resultadoTotal2 = "El número de gente de playa es " . $playeros;
} else {
    $tabla2 = "No hay resultados.";
}


// Ejercicio 3:

$conn->close();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Resolución de ejercicios</title>
    <!-- Enlace a Bootstrap CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

	
	    <link rel="stylesheet" href="estilo.css">

</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Resolución de ejercicios</h2>
        <h4>Ejercicio 1:</h4>
        
        <?php 
        echo $tabla; 
		echo $resultadoTotal;
        ?>
    
    </div>
    
    <div class="container mt-5">
        <h2 class="text-center">Resolución de ejercicios</h2>
        <h4>Ejercicio 1 Alternativa 2:</h4>
        
        <?php 
        echo $tabla2; 
		echo $resultadoTotal2; 
        ?> 
    
    </div>
    
    <!-- Enlace a jQuery y Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
