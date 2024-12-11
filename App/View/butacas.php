<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Distribución de Butacas</title>
    <style>
        .butaca {
            width: 30px;
            height: 30px;
            margin: 2px;
            text-align: center;
            line-height: 30px;
            font-size: 12px;
            font-weight: bold;
            border: 1px solid #000;
            display: inline-block;
            cursor: pointer;
        }
        .disponible { background-color: green; }
        .reservada { background-color: grey; cursor: not-allowed; }
        .seleccionada { background-color: red; }
    </style>
</head>
<body>
    <h1>Distribución de Butacas</h1>

    <form id="reserva-form" method="POST" action="index.php?action=procesarReserva">
        <?php $butacas = isset($butacas) && is_array($butacas) ? $butacas : []; ?>
        <pre><?php print_r($butacas); ?></pre>
        <div style="display: grid; grid-template-columns: repeat(10, 1fr); gap: 5px;">
            <?php foreach ($butacas as $butaca): ?>
                <?php
                    $class = 'disponible';
                    if ($butaca['estado'] === 'reservada') {
                        $class = 'reservada';
                    }
                ?>
                <div class="butaca <?= $class ?>" 
                     data-id="<?= $butaca['id'] ?>" 
                     <?= $class === 'reservada' ? 'disabled' : '' ?>>
                    <?= $butaca['fila'] . $butaca['numero'] ?>
                </div>
            <?php endforeach; ?>
        </div>
        <input type="hidden" name="butacas[]" id="butacas">
        <button type="submit" style="margin-top: 20px;">Reservar</button>
    </form>

    <script>
        const butacas = document.querySelectorAll('.butaca.disponible');
        const form = document.getElementById('reserva-form');
        const butacasInput = document.getElementById('butacas');
        let seleccionadas = [];

        butacas.forEach(butaca => {
            butaca.addEventListener('click', () => {
                const id = butaca.getAttribute('data-id');
                if (seleccionadas.includes(id)) {
                    seleccionadas = seleccionadas.filter(item => item !== id);
                    butaca.classList.remove('seleccionada');
                } else if (seleccionadas.length < 5) {
                    seleccionadas.push(id);
                    butaca.classList.add('seleccionada');
                } else {
                    alert('No puedes seleccionar más de 5 butacas.');
                }
                butacasInput.value = seleccionadas.join(',');
            });
        });
    </script>
</body>
</html>
