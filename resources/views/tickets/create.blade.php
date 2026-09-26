<h1>Nuevo Ticket</h1>

<form method="POST" action="{{ route('tickets.store') }}">
    @csrf
    <div>
        <label>Título</label><br>
        <input type="text" name="titulo" value="{{ old('titulo') }}">
        @error('titulo') <p style="color:red;">{{ $message }}</p> @enderror
    </div>
    <br>
    <div>
        <label>Descripción</label><br>
        <textarea name="descripcion">{{ old('descripcion') }}</textarea>
        @error('descripcion') <p style="color:red;">{{ $message }}</p> @enderror
    </div>
    <br>
    <button type="submit">Crear ticket</button>
</form>
