<h2>Nuevo mensaje de contacto</h2>
<p><strong>Nombre:</strong> {{ $datos['nombre'] }}</p>
<p><strong>Email:</strong> {{ $datos['email'] }}</p>
<p><strong>Teléfono:</strong> {{ $datos['telefono'] ?? 'No especificado' }}</p>
<p><strong>Mensaje:</strong> {{ $datos['mensaje'] }}</p>
