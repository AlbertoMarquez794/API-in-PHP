<?php
    require_once('../include/Generic.php');
    require_once('../classes/Employee.php');

    if ($_SERVER['REQUEST_METHOD'] == 'POST' && 
    isset($_POST['name']) && isset($_POST['email']) && isset($_POST['age']) && isset($_POST['designation'])) {
        $emp = new Employee($_POST['name'], $_POST['email'], $_POST['age'], $_POST['designation']);
        $emp->insertEmployee();
    }


// Verificar si la solicitud es de tipo POST
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Incluir los archivos necesarios
    require_once('../include/Employee.php');

    // Obtener los datos del formulario
    $name = $_POST['name'];
    $email = $_POST['email'];
    $age = $_POST['age'];
    $designation = $_POST['designation'];

    // Crear un nuevo objeto Employee con los datos del formulario
    $new_employee = new Employee($name, $email, $age, $designation);

    // Intentar insertar el nuevo empleado en la base de datos
    $inserted = $new_employee->insertEmployee();

    // Verificar si la inserción fue exitosa
    if ($inserted) {
        // La inserción fue exitosa, devolver una respuesta exitosa
        http_response_code(201); // Created
        echo json_encode(['message' => 'Empleado creado correctamente']);
    } else {
        // La inserción falló, devolver un error
        http_response_code(500); // Internal Server Error
        echo json_encode(['message' => 'Error al crear el empleado']);
    }
} else {
    // La solicitud no es de tipo POST, devolver un error
    http_response_code(405); // Method Not Allowed
    echo json_encode(['message' => 'Método no permitido']);
}
