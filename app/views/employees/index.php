<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Lista de Empleados</title>
</head>
<body>
    <h1>List of Employees</h1>
    <?php if (!empty($employees)): ?>
        <table border="1" cellspacing="0" cellpadding="10">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Age</th>
                    <th>Designation</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($employees as $employee): ?>
                    <tr id="employee-row-<?= htmlspecialchars($employee['id']) ?>">
                        <td><?= htmlspecialchars($employee['id']) ?></td>
                        <td><?= htmlspecialchars($employee['name']) ?></td>
                        <td><?= htmlspecialchars($employee['email']) ?></td>
                        <td><?= htmlspecialchars($employee['age']) ?></td>
                        <td><?= htmlspecialchars($employee['designation']) ?></td>
                        <td>
                            <a href="/API-in-PHP/public/employees/<?= htmlspecialchars($employee['id']) ?>">Search</a> |
                            <a href="/API-in-PHP/public/employees/<?= htmlspecialchars($employee['id']) ?>/edit">Edit</a> |
                            <a href="#" 
                               class="delete-button" 
                               data-id="<?= htmlspecialchars($employee['id']) ?>" >Delete</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php else: ?>
        <p>No hay empleados registrados.</p>
    <?php endif; ?>

    <a href="/API-in-PHP/public/employees/createEmployee">Add new employee</a>

    <script>
        // Add event listener for delete buttons
        document.addEventListener('click', async (event) => {
            if (event.target.classList.contains('delete-button')) {
                event.preventDefault();
                
                // Get employee ID and name from the clicked button
                const employeeId = event.target.getAttribute('data-id');
                const data = { id: parseInt(employeeId, 10) };
                // Show confirmation dialog
                const confirmation = confirm(`Are you sure you want to delete him(her)?`);
                if (!confirmation) return;

                try {
                    // Send DELETE request to the server
                    const response = await fetch(`http://localhost:8080/API-in-PHP/public/employees/deleteEmployee`, {
                        method: 'DELETE',
                        headers: {
                            'Content-Type': 'application/json',
                        },
                        body: JSON.stringify(data),
                    });

                    const contentType = response.headers.get('Content-Type');
                    const text = await response.text();
                    console.log(text);
                    if (contentType && contentType.includes('application/json')) {
                        const result = JSON.parse(text);
                        if (response.ok) {
                            alert(result.message || 'Employee deleted successfully.');
                            
                            // Remove the corresponding row from the table
                            const row = document.getElementById(`employee-row-${employeeId}`);
                            if (row) row.remove();
                        } else {
                            alert(result.error || 'Failed to delete employee.');
                        }
                    } else {
                        console.error('Unexpected response:', text);
                        alert('Unexpected response from server. Please contact support.');
                    }
                } catch (error) {
                    console.error('Error deleting employee:', error);
                    alert('Error connecting to the server. Please try again later.');
                }
            }
        });
    </script>
</body>
</html>


