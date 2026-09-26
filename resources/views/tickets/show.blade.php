<h1>Detalle del Ticket #{{ $ticket->id }}</h1>

<p><strong>Título:</strong> {{ $ticket->titulo }}</p>
<p><strong>Descripción:</strong> {{ $ticket->descripcion }}</p>
<p><strong>Creado por:</strong> {{ $ticket->user->name }}</p>
<p><strong>Estado:</strong> {{ $ticket->estado }}</p>

<a href="{{ route('tickets.index') }}">Volver al listado</a>
