<!DOCTYPE html>
<html>
<head>
<title>VETERINARIA PET'S KINDOM</title>
<link rel="stylesheet" href="css/buscarcat.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="icon" href="IMG/img1.ico">
    <style>
    .caducado {
    color: #ff0000;
    font-weight: bold;
}

.proximo {
    color: #ff8c00;
    font-weight: bold;
}

.vigente {
    color: #008000;
    font-weight: bold;
}
</style>
</head>
<body>
<div class="wrapper">
    <img src="IMG/atras.jpg" alt="" class="fondo">
        <div class="row">
    <?php
    include("conexion.php");
    $con = conectar();

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombreDes_buscar = mysqli_real_escape_string($con, $_POST["nombreDes"]);

        $sql = "SELECT nombreDes, descripcionproducto, fecha_elaboracion, fecha_caducidad, cantidad FROM analgesiosgatos WHERE nombreDes = '$nombreDes_buscar'";
        $query = mysqli_query($con, $sql);

        if ($query) {
            if (mysqli_num_rows($query) > 0) {
                echo '<h1 class="dif">RESULTADOS DE LA <br>BÚSQUEDA</h1>
                <div class="table-container">
                <table class="table">
                    <thead class="sticky-header">
                        <tr>
                            <th>Nombre</th>
                            <th>Descripción</th>
                            <th>Elaboración clas</th>
                            <th>Caducidad clas</th>
                            <th>DIAS</th>
                            <th>Estado</th>
                            <th>Cantidad</th>
                            <th>Opciones</th>
                        </tr>
                    </thead>
                    <div>
                    <tbody>';

                while ($row = mysqli_fetch_array($query)) {
                    $now = time();
                    $expirationDate = strtotime($row['fecha_caducidad']);
                    $timeRemaining = $expirationDate - $now;
                    $daysRemaining = round($timeRemaining / (60 * 60 * 24));
                    $estado = ($daysRemaining <= 0) ? "Caducado" : (($daysRemaining <= 2) ? "proximo" : "Vigente");
                    $estadoClass = ($daysRemaining <= 0) ? "caducado" : (($daysRemaining <= 2) ? "proximo" : "vigente");

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

  
    <a href="M_analgesicosGATOS.php" class="regresar">Regresar </a>
        </div>
</div>
</body>
</html>
