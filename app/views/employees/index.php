<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
    <h1>List of employees</h1>
    <?php if (!empty($employees)): ?>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= htmlspecialchars($employee['id']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['email']) ?></td>
                        <td><?= htmlspecialchars($employee['age']) ?></td>
                        <td>
                            <a href="/employees/<?= htmlspecialchars($employee['id']) ?>">Ver</a> |
                            <a href="/employees/<?= htmlspecialchars($employee['id']) ?>/edit">Editar</a> |
                            <a href="/employees/<?= htmlspecialchars($employee['id']) ?>/delete" onclick="return confirm('¿Estás seguro de eliminar este empleado?')">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay empleados registrados.</p>
    <?php endif; ?>

    <a href="/employees/create">Añadir Nuevo Empleado</a>
</body>
</html>
