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

$place = "";
$study = "";
$tabla = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Verificar si las variables POST existen
    if (isset($_POST['place']) && isset($_POST['study'])) {
        $place = $_POST['place'];
        $study = $_POST['study'];
        
        // Escapar HTML antes de mostrar cualquier dato en la página

        // Utilizar sentencias preparadas para evitar inyecciones SQL
        $stmt = $conn->prepare("SELECT Nombre, Banda FROM ejercicio1 WHERE Lugar = ? AND Estudio = ?");
        $stmt->bind_param("ss", $place, $study);
        $stmt->execute();
        $result = $stmt->get_result();

        $tabla = "";  

        if ($result->num_rows > 0) {
            $id = 0;
            $tabla = "<table class='table'>
            <tr>
                <th>Id</th>
                <th>Nombre</th>
                <th>Banda favorita</th>
            </tr>";
            
            while ($row = $result->fetch_assoc()) {
                $id++;
                $tabla .= "
                <tr>
                    <td>" . htmlspecialchars($id) . "</td>
                    <td>" . htmlspecialchars($row["Nombre"]) . "</td>
                    <td>" . htmlspecialchars($row["Banda"]) . "</td>
                </tr>";
            }
            $tabla .= "</table>";  // Cerrar la tabla después de agregar todas las filas
        } else {
            $tabla = "No hay resultados.";
        }

        $stmt->close();
    } else {
        // Mensaje en caso de que los valores de POST no existan
        $tabla = "Por favor, complete todos los campos.";
    }
}

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
        
        <!-- Mostrar la tabla o mensajes -->
        <?php 
        echo $tabla; 
        ?>
    
    </div>
    
    <!-- Enlace a jQuery y Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>
