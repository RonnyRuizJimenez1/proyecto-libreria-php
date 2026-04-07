<?php
include 'config.php';

// 🔍 BUSCADOR
$buscar = $_GET['buscar'] ?? '';

$query = $conexion->prepare("
    SELECT * FROM autores 
    WHERE nombre LIKE ? OR apellido LIKE ?
    ORDER BY apellido ASC
");

$query->execute(["%$buscar%", "%$buscar%"]);
$autores = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="index.php">📚 Librería</a>

        <div>
            <a class="nav-link d-inline text-white" href="index.php">Inicio/</a>
            <a class="nav-link d-inline text-white" href="libros.php">Libros/</a>
            <a class="nav-link d-inline text-white" href="autores.php">Autores/</a>
            <a class="nav-link d-inline text-white" href="contacto.php">Contacto</a>
        </div>
    </div>
</nav>
    <meta charset="UTF-8">
    <title>Autores</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
            color: white;
        }

        .card {
            border-radius: 15px;
            transition: 0.3s;
        }

        .card:hover {
            transform: scale(1.03);
        }
    </style>
</head>

<body>

<div class="container mt-5">

    <h1 class="text-center mb-4"> Autores</h1>

    <form method="GET" class="mb-4">
        <input type="text" name="buscar" class="form-control"
        placeholder="Buscar autor..."
        value="<?php echo $buscar; ?>">
    </form>

    <div class="row">

        <?php foreach($autores as $autor): ?>

            <div class="col-md-4 mb-4">
                <div class="card bg-dark text-light p-3 shadow">

                    <h5>
                        <?php echo $autor['nombre'] . " " . $autor['apellido']; ?>
                    </h5>

                    <p>📞 <?php echo $autor['telefono']; ?></p>

                    <p>
                         <?php echo $autor['ciudad']; ?>, 
                        <?php echo $autor['estado']; ?> (<?php echo $autor['pais']; ?>)
                    </p>

                    <p style="font-size: 13px;">
                        <?php echo $autor['direccion']; ?>
                    </p>

                </div>
            </div>

        <?php endforeach; ?>

    </div>

</div>

<footer class="text-center mt-5 p-3 bg-dark text-white">
    © 2026 Librería - Proyecto Final
</footer>
</body>
</html>