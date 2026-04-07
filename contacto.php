<?php
include 'config.php';

$mensaje = "";
$libroSeleccionado = $_GET['libro'] ?? '';

if ($_POST) {

    $stmt = $conexion->prepare("
        INSERT INTO contacto (correo, nombre, asunto, comentario)
        VALUES (?, ?, ?, ?)
    ");

    $stmt->execute([
        $_POST['correo'],
        $_POST['nombre'],
        $_POST['asunto'],
        $_POST['comentario']
    ]);

    $mensaje = "✅ Mensaje enviado correctamente";
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Contacto</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #0f172a;
            color: white;
        }

        .form-control {
            margin-bottom: 10px;
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

    <h1 class="text-center mb-4">📩 Contáctanos</h1>

    <?php if($mensaje): ?>
        <div class="alert alert-success">
            <?php echo $mensaje; ?>
        </div>
    <?php endif; ?>

    <!-- FORM -->
    <form method="POST" id="formContacto" class="bg-dark p-4 rounded shadow">

        <input type="text" name="nombre" class="form-control" placeholder="Nombre" required>

        <input type="email" name="correo" class="form-control" placeholder="Correo" required>

        <input type="text" name="asunto" class="form-control"
        value="<?php echo $libroSeleccionado; ?>"
        placeholder="Libro de interés" required>

        <textarea name="comentario" class="form-control" placeholder="Comentario" required></textarea>

        <button type="submit" class="btn btn-success w-100 mt-2">
            Enviar por WhatsApp 📲
        </button>

    </form>

</div>

<footer class="text-center mt-5 p-3 bg-dark text-white">
    © 2026 Librería - Proyecto Final
</footer>

<!-- 🔥 SCRIPT WHATSAPP -->
<script>
document.getElementById("formContacto").addEventListener("submit", function(e) {

    // 🔥 NO cancelar submit → deja que PHP guarde en BD
    // pero abrimos WhatsApp INMEDIATAMENTE

    let nombre = document.querySelector('[name="nombre"]').value;
    let correo = document.querySelector('[name="correo"]').value;
    let asunto = document.querySelector('[name="asunto"]').value;
    let comentario = document.querySelector('[name="comentario"]').value;

    let texto = `Hola, soy ${nombre}\nCorreo: ${correo}\nLibro: ${asunto}\nMensaje: ${comentario}`;

    let mensaje = encodeURIComponent(texto);

    let telefono = "18496536302";

    // 🔥 abrir antes de que el form recargue
    window.open(`https://wa.me/${telefono}?text=${mensaje}`, "_blank");

});
</script>

</body>
</html>