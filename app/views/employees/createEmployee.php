<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add new employee</h1>
    <form id="createEmployeeForm">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>

        <label for="designation">Designation:</label><br>
        <input type="text" id="designation" name="designation" required><br><br>

        <button type="submit">Submit</button>
    </form>

    <script>
       const form = document.getElementById('createEmployeeForm');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const age = parseInt(document.getElementById('age').value.trim(), 10);
            const designation = document.getElementById('designation').value.trim();

    
            // Crear el cuerpo de la solicitud
            const data = { name, email, age, designation };

            try {
                const response = await fetch(`http://localhost:8080/API-in-PHP/public/employees/newEmployee`, {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                    },
                    body: JSON.stringify(data),
                });
                const contentType = response.headers.get('Content-Type');
                const text = await response.text();
                
                if (contentType && contentType.includes('application/json'))
                {
                    const result = JSON.parse(text);
                    
                    if (response.ok) {
                        alert(result.message || 'Employee added successfully!'); // Mensaje exitoso
                    } else {
                        alert(`Error: ${result.error || 'Unable to add employee'}`); // Mensaje de error
                    }
                } else {
                    alert('Unexpected response format. Please contact support.');
                }
            } catch (error) {
                console.error('Hubo un error al procesar la solicitud:', error);
                alert('Error al conectar con el servidor.');
            }
        });
    </script>
</body>
</html>
