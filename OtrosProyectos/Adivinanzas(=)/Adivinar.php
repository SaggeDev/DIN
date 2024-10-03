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
    $sql = "SELECT * FROM Adivinanzas ORDER BY RAND() LIMIT 1";


    $tabla = "";  // Inicializar la variable
    $nombre = ""; // Inicializar la variable

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $Enunciado = $row["Enunciado"];
        $resultado = $row["Respuesta"];
        $tabla = "<table class='table table-bordered'>
        <tr>
            <th>
            Enunciado
            <button class='btn btn-primary' style='float: right;' onclick='location.reload();' >Cambiar adivinanza</button>
            </th>
        </tr>
        <tr>
            <td>" . $row["Enunciado"] . "</td>
        </tr>
        </table>";
    } else {
        $tabla = "No hay resultados";
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
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Adivina</h2>
        <?php echo $tabla; // Mostrar la tabla o mensaje de "No hay resultados" ?>
        
        <!-- Formulario para comprobar el nombre -->
        <form id="formulario">
            
                <div class="form-group">
                    <table class='table table-bordered'>
                        <tr>
                            <th for="name">Que es?</th>
                        </tr>
                        <tr>
                            <th for="name">
                            <input type="text" class="form-control" name="nombre" id="nombreIngresadoId" placeholder="Introduce el resultado">
                            <input type="hidden" id="nombre_aleatorio" value="<?php echo $resultado; ?>"> <!-- Campo oculto con el nombre -->
                            </th>
                        </tr>
                        

                    </table>
                </div>
            <div class="text-center mt-4">
                <button class="btn btn-primary" type="submit">Comprueba el resultado</button>
            </div>
        </form>

        <!-- Mostrar el resultado de la comprobación -->
        <div id="resultado" class="text-center mt-3 alert alert-info" style="display: none;"></div>

        <!-- Botón para refrescar la página -->
        <div class="text-center mt-4">
            <button class="btn btn-warning" onclick="window.location.href='Introducir.php'">Introducir Adivinanzas</button>
        </div>
    </div>
    
    <!-- Enlace a jQuery y Bootstrap JS -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

    <script>
    $(document).ready(function() {
        $('#formulario').on('submit', function(event) {
            event.preventDefault(); // Evitar la recarga de la página
            
            var nombreIngresado = $('#nombreIngresadoId').val().trim();
            var nombreAleatorio = $('#nombre_aleatorio').val().trim(); 
            if (nombreIngresado.toLowerCase() === nombreAleatorio.toLowerCase()) {
                $('#resultado').show().text("Éxito"); // Mostrar éxito
				
            } else {
                $('#resultado').show().text("Inténtalo de nuevo"); // Mostrar fallo
            }
        });
    }); 
    </script>
</body>
</html>



