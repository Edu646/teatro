<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    <?php if(isset($_SESSION['username'])): ?>
        <div class='user-info'>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <form action='logout.php' method='post'>
                <button type='submit'>Cerrar sesión</button>
            </form>
        </div>
    <?php endif; ?>
    <?php if(isset($_SESSION['username'])): ?>
        <div class='user-info'>
            <p>Bienvenido, <?php echo htmlspecialchars($_SESSION['username']); ?>!</p>
            <form action='logout.php' method='post'>
                <button type='submit'>Cerrar sesión</button>
            </form>
        </div>
    <?php endif; ?>
    <ul>
        <li><a href="http://localhost/prueba_teatrillo/App/View/login.php">Iniciar Sesión</a></li>
        <li><a href="http://localhost/prueba_teatrillo/App/View/register.php">Registrarse</a></li>
        <li><a href="http://localhost/prueba_teatrillo/App/View/butacas.php">Butaca</a></li>
    </ul>
</body>
</html>