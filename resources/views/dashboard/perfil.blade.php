@extends('layouts.dash')
@section('title', 'Perfil')


@section('content')
<div class="perfil-dashboard">
    <h1 class="text-center">Perfil</h1>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Usuario</th>
                <th>CRECI</th>
                <th>Email</th>
                <th>Usuario desde</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $datos['name'] }}</td>
                <td>{{ $datos['creci'] }}</td>
                <td>{{ $datos['email'] }}</td>
                <td>{{ $datos['date'] }}</td>
            </tr>
        </tbody>
    </table>

    <br>

    <h1 class="text-center">Tokens</h1>
    <table class="table text-center">
        <thead>
            <tr>
                <th>Tokens comprados</th>
                <th>Tokens gastados</th>
                <th>Tokens disponiveis</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>{{ $tokens['comprado'] }}</td>
                <td>{{ $tokens['gasto'] }}</td>
                <td>{{ $tokens['total'] }}</td>
            </tr>
        </tbody>
    </table>

</div>

<script>

</script>

@endsection