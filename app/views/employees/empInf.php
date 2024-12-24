<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>Employee with id 
        <?php 
            echo $employeeData[0]['id'];
        ?>
    </h1>
    <p>Name: <?php echo $employeeData[0]['name'] ?> </p>
    <p>Email: <?php echo $employeeData[0]['email'] ?> </p>
    <p>Age: <?php echo $employeeData[0]['age'] ?> </p>
    <p>Designation: <?php echo $employeeData[0]['designation'] ?> </p>
</body>
</html>
