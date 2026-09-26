<h1>Editar Ticket #{{ $ticket->id }}</h1>

<form method="POST" action="{{ route('tickets.update', $ticket) }}">
    @csrf
    @method('PUT')
    <div>
        <label>Título</label><br>
        <input type="text" name="titulo" value="{{ old('titulo', $ticket->titulo) }}">
        @error('titulo') <p style="color:red;">{{ $message }}</p> @enderror
    </div>
    <br>
    <div>
        <label>Descripción</label><br>
        <textarea name="descripcion">{{ old('descripcion', $ticket->descripcion) }}</textarea>
        @error('descripcion') <p style="color:red;">{{ $message }}</p> @enderror
    </div>
    <br>
    <button type="submit">Actualizar ticket</button>
</form>
