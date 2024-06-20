<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<?php
print_r($datos);
?>
<body>
    <h1>Hola <?php echo $datos['usuarioSesion']->nombre_completo ?></h1>

</body>
</html>