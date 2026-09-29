<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Formulario de Contacto</title>
</head>
<body>
    @if(session('exito'))
        <p style="color: green;">{{ session('exito') }}</p>
    @endif

    @if ($errors->any())
        <ul style="color: red;">
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ url('/mail/enviar') }}" method="POST">
        @csrf
        <div>
            <label>Nombre:</label>
            <input type="text" name="nombre" value="{{ old('nombre') }}">
        </div>
        <div>
            <label>Email:</label>
            <input type="email" name="email" value="{{ old('email') }}">
        </div>
        <div>
            <label>Teléfono (opcional):</label>
            <input type="text" name="telefono" value="{{ old('telefono') }}">
        </div>
        <div>
            <label>Mensaje:</label>
            <textarea name="mensaje">{{ old('mensaje') }}</textarea>
        </div>
        <button type="submit">Enviar</button>
    </form>
</body>
</html>
