<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ADI</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<div class="w-50 p-3 mx-auto">
    <header>
        <h1>Insertar Adivinanza</h1>
    </header>
    
    <form class="mx-5 p-2" action="" method="POST">
        <div class="form-group row">
            <label for="enunIN">Enunciado: </label>
            <input type="text" placeholder="*" class="form-control" id="enunIN" name="enunIN" required>
        </div>
        <div class="form-group row">
            <label for="respIN">Respuesta: </label>
            <input type="text" placeholder="*" class="form-control" id="respIN" name="respIN" required>
        </div>
        <div class="text-center mt-4">
        <button type="submit" class="btn btn-primary mt-1" id="buttonEnviar">Enviar</button>
        </div>
    </form>
    <div class="text-center ">
            <button class="btn btn-warning" onclick="window.location.href='Adivinar.php'">Adivinar</button>  
    </div>
</div>

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

    // Verificar si se han enviado datos por POST
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Obtener los datos del formulario
        $enunciado = $_POST['enunIN'];  
        $respuesta = $_POST['respIN']; 

        // Preparar la consulta SQL
        $sql = "INSERT INTO Adivinanzas (Enunciado, Respuesta) 
                VALUES (?, ?)";

        $stmt = $conn->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("ss", $enunciado, $respuesta);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "<h2 class='mx-5 p-2'>Información almacenada con éxito</h2>";
                echo "<p class='mx-5 p-2'>Enunciado: " . $enunciado . "</p>";
                echo "<p class='mx-5 p-2'>Respuesta: " . $respuesta . "</p>";
            } else {
                echo "<h2 class='mx-5 p-2'>Error al ejecutar la consulta: " . $stmt->error . "</h2>";
            }

            // Cerrar la declaración
            $stmt->close();
        } else {
            echo "Error al preparar la consulta: " . $conn->error;
        }
    }

    // Cerrar la conexión
    $conn->close();
?>

</body>
</html>
