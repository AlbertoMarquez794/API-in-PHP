<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
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
                    <th>Designation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr>
                        <td><?= htmlspecialchars($employee['id']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['email']) ?></td>
                        <td><?= htmlspecialchars($employee['age']) ?></td>
                        <td><?= htmlspecialchars($employee['designation']) ?></td>
                        <td>
                            <a href="/API-in-PHP/public/employees/<?= htmlspecialchars($employee['id']) ?>">Search</a> |
                            <a href="/API-in-PHP/public/employees/<?= htmlspecialchars($employee['id']) ?>/edit">Edit</a> |
                            <a href="/employees/<?= htmlspecialchars($employee['id']) ?>/delete" onclick="return confirm('Are you sure that you want to delete him (her)?')">Delete</a>
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
