@extends('layouts.app')

@section('template_title')
{{ $usuario->email ?? 'Confirm Disabled Usuario' }}
@endsection

@section('content')
<div class="container py-5">
	<h1>¿Deseas deshabilitar el registro de "{{ $usuario->nombreCompleto }} - {{ $usuario->email }}"? </h1>

<form method="post" action="{{ route('usuarios.destroy', $usuario->email )}}">
	@method('DELETE')
	@csrf
	<button type="submit" class="redondo btn btn-danger">
		<i class="fas fa-trash-alt"></i> Eliminar
	</button>
	<a class="redondo btn btn-secondary" href="{{ route('usuarios.index') }}">
		<i class="fas fa-ban"></i> Cancelar
	</a>
</form>

</div>

@endsection
