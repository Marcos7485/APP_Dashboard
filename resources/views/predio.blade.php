@extends('layouts.main')
@section('title', 'Título de inicio')

@section('content')
    <div class="container-fluid">
        <div class="proprietario">
            <table class="table text-center">
                <thead>
                    <tr>
                        <td>
                            <h1>Prédio</h1>
                        </td>
                    </tr>
                    <tr>
                        <td></td>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>
                            <p>Propriedades do prédio:</p>
                        </td>
                    </tr>
                    @for ($i = 0; $i < count($data['resultados']); $i++)
                        @php $encodedInscr = base64_encode(json_encode($data['inscr'][$i])); // Convertir el array a JSON y luego codificar a Base64 @endphp
                        <tr>
                            <td>
                                @foreach ($data['resultados'][$i] as $endereco)
                                    <a href="/info/{{ $encodedInscr }}">{{ $endereco }}</a>
                                @endforeach
                            </td>
                        </tr>
                    @endfor
                </tbody>
            </table>
        </div>
    </div>
@endsection
