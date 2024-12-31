<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Employee</title>
</head>
<body>
    <h1>Add new employee</h1>
    <form id="updateEmployeeForm">
        <label for="name">Name:</label><br>
        <input type="text" id="name" name="name" required><br><br>

        <label for="email">Email:</label><br>
        <input type="email" id="email" name="email" required><br><br>

        <label for="age">Age:</label><br>
        <input type="number" id="age" name="age" required><br><br>

        <label for="designation">Designation:</label><br>
        <input type="text" id="designation" name="designation" required><br><br>

        <button type="submit">Actualizar</button>
    </form>

    <script>
       const form = document.getElementById('updateEmployeeForm');
        form.addEventListener('submit', async (event) => {
            event.preventDefault();

            // Obtener los datos del formulario
            const id = document.getElementById('id').value.trim();
            const name = document.getElementById('name').value.trim();
            const email = document.getElementById('email').value.trim();
            const age = parseInt(document.getElementById('age').value.trim(), 10);
            const designation = document.getElementById('designation').value.trim();

            // Validación de los datos del formulario
            if (!id || !name || !email || isNaN(age) || !designation) {
                alert("Por favor, complete todos los campos correctamente.");
                return;
            }

            // Crear el cuerpo de la solicitud
            const data = { name, email, age, designation };

            try {
                const response = await fetch(`http://localhost:8080/API-in-PHP/public/employees/up/${id}`, {
                    method: 'PUT',
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
                        console.log(result.message); // Mensaje exitoso
                    } else {
                        console.error(result.error); // Mensaje de error
                    }
                } else {
                    console.error('Respuesta no es JSON:', text);
                }
            } catch (error) {
                console.error('Hubo un error al procesar la solicitud:', error);
                alert('Error al conectar con el servidor.');
            }
        });
    </script>
</body>
</html>
