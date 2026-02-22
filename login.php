<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? null;
    $password = $_POST['password'] ?? null;

    if (!$email || !$password) {
        die("Por favor ingresa email y contraseña.");
    }

    // Login
    $url = "http://127.0.0.1:8000/api/login";
    $data = ["email" => $email, "password" => $password];

    $ch = curl_init($url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_HTTPHEADER, ["Content-Type: application/json"]);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $response = curl_exec($ch);
    curl_close($ch);

    $result = json_decode($response, true);

    if (isset($result['token'])) {
        $_SESSION['token'] = $result['token'];

        // Obtener datos del usuario autenticado
        $userUrl = "http://127.0.0.1:8000/api/usuarios?email=" . urlencode($email);
        $ch = curl_init($userUrl);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer " . $_SESSION['token']
        ]);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $userResponse = curl_exec($ch);
        curl_close($ch);

        $userData = json_decode($userResponse, true);

        // Si la API devuelve un array, buscar el usuario por email
        $selectedUser = null;
        if (is_array($userData)) {
            foreach ($userData as $u) {
                if (isset($u['email']) && strtolower($u['email']) === strtolower($email)) {
                    $selectedUser = $u;
                    break;
                }
            }
        } else {
            $selectedUser = $userData;
        }

        // Si no se encontró, fallback
        if (!$selectedUser) {
            die("No se encontró el usuario con ese correo.");
        }

        // Detectar campo de rol (ajusta según tu API)
        $role = $selectedUser['role']
            ?? $selectedUser['rol']
            ?? $selectedUser['tipo']
            ?? "user";

        $role = strtolower($role);

        // Guardar en sesión
        $_SESSION['user'] = [
            "name" => $selectedUser['name'] ?? null,
            "email" => $selectedUser['email'] ?? null,
            "role" => $role
        ];

        // Redirigir según rol
        if ($_SESSION['user']['role'] === 'admin') {
            header("Location: admin/admin_menu.php");
        } else {
            header("Location: user/user_menu.php");
        }
        exit;
    } else {
        echo "Error al iniciar sesión: " . json_encode($result);
    }
}
?>


<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Nexus Corp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <link rel="stylesheet" href="./css/login.css">
</head>

<body class="login-body d-flex align-items-center justify-content-center">

    <div class="login-card card p-4 text-white">
        <div class="text-center mb-4">
            <i class="bi bi-building-fill fs-1 text-morado"></i>
            <h2 class="mt-2">Nexus Corp</h2>
            <p class="text-secondary">Employee Management Portal</p>
        </div>

        <h4 class="text-center mb-3">Bienvenido de nuevo</h4>
        <p class="text-center text-secondary">Ingresa tus credenciales para continuar</p>

        <form action="login.php" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Correo electrónico</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="name@company.com" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Contraseña</label>
                <div class="input-group">
                    <input type="password" class="form-control" id="password" placeholder="••••••••" name="password" required>

                </div>
            </div>

            <div class="d-flex justify-content-between align-items-center mb-3">
                <div class="form-check">
                    <input class="form-check-input" type="checkbox" id="remember">
                    <label class="form-check-label" for="remember">Recordarme</label>
                </div>
                <a href="#" class="text-morado text-decoration-none">¿Olvidaste tu contraseña?</a>
            </div>

            <button type="submit" class="btn btn-morado w-100">Iniciar sesión</button>
        </form>

        <div class="mt-4 text-center">
            <a href="signin.php" class="text-morado text-decoration-none">¿No tienes cuenta? Iniciala aqui!</a>
            <hr>
            <a href="#" class="text-secondary text-decoration-none">Contactar soporte IT</a>
            <div class="mt-2">
                <a href="#" class="text-secondary text-decoration-none me-3">Política de privacidad</a>
                <a href="#" class="text-secondary text-decoration-none">Términos de servicio</a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.8/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>