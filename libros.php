<?php
include 'config.php';

$buscar = $_GET['buscar'] ?? '';

$query = $conexion->prepare("SELECT * FROM titulos WHERE titulo LIKE ?");
$query->execute(["%$buscar%"]);
$libros = $query->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Libros</title>

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

        .badge {
            font-size: 12px;
        }
    </style>
</head>

<body>
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
<div class="container mt-5">

    <h1 class="text-center mb-4">📚 Librería Online</h1>

    <form method="GET" class="mb-4">
        <input type="text" name="buscar" class="form-control" placeholder="Buscar libro...">
    </form>
    

    <div class="row">

        <?php foreach($libros as $libro): ?>
            
            <div class="col-md-4 mb-4">
            <a href="contacto.php?libro=<?php echo urlencode($libro['titulo']); ?>" 
            style="text-decoration:none; color:inherit;">

        <div class="card bg-dark text-light p-3 shadow">

            <h5 class="mb-2"><?php echo $libro['titulo']; ?></h5>

            <img src="https://placehold.co/300x200/<?php echo dechex(rand(0x000000, 0xFFFFFF)); ?>/ffffff?text=Libro" class="img-fluid mb-2">

            <span class="badge bg-primary mb-2">
                <?php echo $libro['tipo']; ?>
            </span>

            <p><strong>Precio:</strong> $<?php echo $libro['precio']; ?></p>

            <p><strong>Fecha:</strong> <?php echo date("d/m/Y", strtotime($libro['fecha_pub'])); ?></p>

            <p><strong>Ventas:</strong> <?php echo $libro['total_ventas']; ?></p>

            <p style="font-size: 13px;">
                <?php echo substr($libro['notas'], 0, 80); ?>...
            </p>

        </div>

    </a>

</div>

        <?php endforeach; ?>

    </div>

</div>


<footer class="text-center mt-5 p-3 bg-dark text-white">
    © 2026 Librería - Proyecto Final
</footer>
</body>
</html>