<?php
// Datos de conexión a la base de datos
$servername = "db5016215000.hosting-data.io";
$username = "dbu5457056";
$password = "Ejercicios_2425";
$dbname = "dbs13197585";

// Crear la conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar la conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$tabla = "";  // Inicializar la variable
$nombre = ""; // Inicializar la variable

$sql = "SELECT Nombre, Edad, BandaFavorita, ComidaFavorita, PeliculaFavorita,
 MeConsidero, SoyMasDe, Estudio, Busqueda, MiRollo FROM ejercicio4 ORDER BY RAND() LIMIT 1";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $row = $result->fetch_assoc();
    $nombre = $row["Nombre"];
    $tabla = "<table class='table table-bordered'>
    <tr>
        <th>Edad</th>
        <th>Banda favorita</th>
        <th>Comida favorita</th>
        <th>Pelicula favorita</th>
        <th>Me considero</th>
        <th>Soy más de</th>
        <th>Estudio</th>
        <th>Busqueda rara en google</th>
        <th>Mi rollo es</th>
    </tr>
    <tr>
        <td>" . $row["Edad"] . "</td>
        <td>" . $row["BandaFavorita"] . "</td>
        <td>" . $row["ComidaFavorita"] . "</td>
        <td>" . $row["PeliculaFavorita"] . "</td>
        <td>" . $row["MeConsidero"] . "</td>
        <td>" . $row["SoyMasDe"] . "</td>
        <td>" . $row["Estudio"] . "</td>
        <td>" . $row["Busqueda"] . "</td>
        <td>" . $row["MiRollo"] . "</td>
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
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
    <div class="container mt-5">
        <h2 class="text-center">Adivina quién soy</h2>
        <h4>¿Quién soy?:</h4>
        <?php echo $tabla; // Mostrar la tabla o mensaje de "No hay resultados" ?>
        
        <!-- Formulario para comprobar el nombre -->
        <form id="formulario">
            <div class="text-center mt-4">
                <div class="form-group">
                    <label for="name">Nombre:</label>
                    <input type="text" class="form-control" name="nombre" id="nombreIngresadoId" placeholder="Introduce tu nombre">
                    <input type="hidden" id="nombre_aleatorio" value="<?php echo $nombre; ?>"> <!-- Campo oculto con el nombre -->
                </div>
                <button class="btn btn-primary" type="submit">Comprueba el resultado</button>
            </div>
        </form>

        <!-- Mostrar el resultado de la comprobación -->
        <div id="resultado" class="text-center mt-3 alert alert-info" style="display: none;"></div>

        <!-- Botón para refrescar la página -->
        <div class="text-center mt-4">
            <button class="btn btn-primary" onclick="location.reload();">Recargar página</button>
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
