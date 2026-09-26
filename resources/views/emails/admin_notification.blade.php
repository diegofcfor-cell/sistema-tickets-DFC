<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nuevo Usuario</title>
</head>
<body style="font-family: Arial, sans-serif; padding: 20px;">
    <h2>¡Se ha registrado un nuevo usuario!</h2>
    <p>Detalles del registro:</p>
    <ul>
        <li><strong>Nombre:</strong> {{ $user->name }}</li>
        <li><strong>Email:</strong> {{ $user->email }}</li>
        <li><strong>Fecha de registro:</strong> {{ $user->created_at->format('d/m/Y H:i') }}</li>
    </ul>
</body>
</html>
