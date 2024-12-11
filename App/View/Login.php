<?php
session_start();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h1>Iniciar Sesión</h1>
    <?php if(isset($_SESSION['username'])): ?>
        <div class='user-info'>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <form action='logout.php' method='post'>
                <button type='submit'>Cerrar sesión</button>
            </form>
        </div>
    <?php else: ?>
        <form action="/prueba_teatrillo/App/Controllers/LoginController.php" method="POST">
            <label for="nombre_usuario">Nombre de Usuario:</label>
            <input type="text" id="nombre_usuario" name="nombre_usuario" required><br><br>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required><br><br>

            <button type="submit">Iniciar Sesión</button>
        </form>
    <?php endif; ?>


    <?php if (isset($_GET['error'])): ?>
        <p style="color: red;"><?php echo htmlspecialchars($_GET['error']); ?></p>
    <?php endif; ?>
</body>
</html>
