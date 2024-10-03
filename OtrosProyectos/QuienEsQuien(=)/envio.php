<html>
    <body>

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
    if ($_SERVER["REQUEST_METHOD"] == "POST") {//Esto verififica si se ha enviado algo por POST y prevendrá que se ejecute el código si no se ha enviado nada desde la pagina anterior
        // Obtener los datos del formulario
        $nombre = $_POST['name'];
        $edad = $_POST['age'];
        $banda_favorita = $_POST['music'];
        $comida_favorita = $_POST['food'];
        $pelicula_favorita = $_POST['movie'];
        $soy_mas_de = $_POST['place'];
        $estudio = $_POST['study'];

        // Preparar la consulta SQL
        $sql = "INSERT INTO ejercicio1 (Nombre, Edad, Banda, Comida, Pelicula, Lugar, Estudio) 
                VALUES (?, ?, ?, ?, ?, ?, ?)";

        $stmt = $conn->prepare($sql);

        if ($stmt) {
            $stmt->bind_param("sisssss", $nombre, $edad, $banda_favorita, $comida_favorita, 
            $pelicula_favorita, 
            $soy_mas_de, $estudio);

            // Ejecutar la consulta
            if ($stmt->execute()) {
                echo "<h2>Información almacenada con éxito</h2>";
                echo "<p>Nombre: ".$nombre."</p>";
                echo "<p>Edad: ".$edad."</p>";
                echo "<p>Banda favorita: ".$banda_favorita."</p>";
                echo "<p>Comida favorita: ".$comida_favorita."</p>";
                echo "<p>Pelicula favorita: ".$pelicula_favorita."</p>";
                echo "<p>Soy más de: ".$soy_mas_de."</p>";
                echo "<p>Estudio: ".$estudio."</p>";
            } else {
                echo "Error al ejecutar la consulta: " . $stmt->error;
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
<button onclick="window.location.href='ejercicio3.php'">Mostrar los resultados de la base de datos</button>
    </body>
</html>






















<!--Cuidado, este archivo no se guarda en el localhost, sino en din. a la proxima guardar en el localhost directamentey hacer la copia de seguridad en din-->