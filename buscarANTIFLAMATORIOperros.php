<!DOCTYPE html>
<html>
<head>
<title>VETERINARIA PET'S KINDOM</title>
    <link rel="stylesheet" href="css/tablas.css">
    <link rel="stylesheet" href="css/perro.css">
    <link rel="stylesheet" href="css/buscar.css">
    <link rel="icon" href="IMG/img1.ico">
</head>
<body>
    <?php
    include("conexion.php");
    $con = conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreDes_buscar = mysqli_real_escape_string($con, $_POST["nombreDes"]);

        $sql = "SELECT nombreDes, descripcionproducto, fecha_elaboracion, fecha_caducidad, cantidad FROM antifflamatoriosperros WHERE nombreDes = '$nombreDes_buscar'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                echo '<h1>RESULTADOS DE LA BÚSQUEDA</h1>
                <table class="table">
                    <thead class="sticky-header">
                        <tr>
                            <th>Nombre<i class="fas fa-chevron-down"></i></th>
                            <th>Descripción<i class="fas fa-chevron-down"></i></th>
                            <th>Elaboración<i class="fas fa-chevron-down"></i></th>
                            <th>Caducidad<i class="fas fa-chevron-down"></i></th>
                            <th>DIAS<i class="fas fa-chevron-down"></i></th>
                            <th>Estado<i class="fas fa-chevron-down"></i></th>
                            <th>Cantidad<i class="fas fa-chevron-down"></i></th>
                            <th>Opciones<i class="fas fa-chevron-down"></i></th>
                        </tr>
                    </thead>
                    <tbody>';

                while ($row = mysqli_fetch_array($query)) {
                    $now = time();
                    $expirationDate = strtotime($row['fecha_caducidad']);
                    $timeRemaining = $expirationDate - $now;
                    $daysRemaining = round($timeRemaining / (60 * 60 * 24));
                    $estado = ($daysRemaining <= 0) ? "Caducado" : "Vigente";
                    $estadoClass = ($daysRemaining <= 0) ? "caducado" : "";

                    echo "<tr>";
                    echo "<td>" . $row['nombreDes'] . "</td>";
                    echo "<td>" . $row['descripcionproducto'] . "</td>";
                    echo "<td>" . $row['fecha_elaboracion'] . "</td>";
                    echo "<td>" . $row['fecha_caducidad'] . "</td>";
                    echo "<td id='countdown-" . $row['nombreDes'] . "'>" . $daysRemaining . " días</td>";
                    echo "<td class='" . $estadoClass . "'>" . $estado . "</td>";
                    echo "<td>" . $row['cantidad'] . "</td>";
                    echo "<td><a href='eliminar.php?nombreDes=" . $row['nombreDes'] . "' class='btn btn-danger'><i class='fas fa-trash'></i></a>
                    <a href='actualizar.php?nombreDes=" . $row['nombreDes'] . "' class='btn btn-danger'><i class='fas fa-edit'></i> </td>";
                    echo "</tr>";
                }

                echo '</tbody>
                    </table>';

            } else {
                echo "No se encontraron resultados.";
            }
        } else {
            echo "Error en la consulta: " . mysqli_error($con);
        }
    }

    mysqli_close($con);
    ?>

    <!-- Botón de regreso a perros.php -->
    <a href="M_antiflamatorioperros.php " class="regresar">Regresar</a>
</body>
</html>
