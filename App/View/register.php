<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro de Usuario</title>
    <style>
        .success-message { color: green; padding: 10px; margin: 10px 0; }
        .error-message { color: red; padding: 10px; margin: 10px 0; }
    </style>
</head>
<body>
    <h1>Registro de Usuario</h1>
    
    <?php if (isset($_GET['success'])): ?>
        <div class="success-message">
            <?php 
                echo htmlspecialchars($_GET['success']); 
                if (isset($_GET['username'])) {
                    echo "<br>Tu nombre de usuario es: " . htmlspecialchars($_GET['username']);
                }
            ?>
        </div>
    <?php endif; ?>

    <?php if (isset($_GET['error'])): ?>
        <div class="error-message">
            <?php echo htmlspecialchars($_GET['error']); ?>
        </div>
    <?php endif; ?>

    <form action="/prueba_teatrillo/App/Controllers/UserController.php" method="POST">
        <label for="nombre">Nombre:</label>
        <input type="text" id="nombre" name="nombre" required><br><br>

        <label for="primer_apellido">Primer Apellido:</label>
        <input type="text" id="primer_apellido" name="primer_apellido" required><br><br>

        <label for="segundo_apellido">Segundo Apellido:</label>
        <input type="text" id="segundo_apellido" name="segundo_apellido" required><br><br>

        <label for="dni">DNI:</label>
        <input type="text" id="dni" name="dni" required><br><br>

        <label for="password">Contraseña:</label>
        <input type="password" id="password" name="password" required><br><br>

        <label for="confirm_password">Confirmar Contraseña:</label>
        <input type="password" id="confirm_password" name="confirm_password" required><br><br>

        <button type="submit">Registrar</button>
    </form>

</body>
</html>
