@extends('layouts.main')
@section('title', 'Título de inicio')


@section('content')
<div class="container-fluid">
    <div class="proprietario">
        <table class="table text-center">
            <thead>
                <tr>
                    <td colspan="2"><h1>Proprietario</h1></td>
                </tr>
                <tr>
                    <td colspan="2"></td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <p>Nome</p>
                    </td>
                    <td>
                        <p>{{$data['nome']}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>CPF/CNPJ</p>
                    </td>
                    <td>
                        <p>{{$data['doc']}}</p>
                    </td>
                </tr>
                <tr>
                    <td>
                        <p>Endereço</p>
                    </td>
                    <td>
                        @foreach($data['endereco'] as $value)
                        <p>{{ $value }}</p>
                        @endforeach
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>

@endsection