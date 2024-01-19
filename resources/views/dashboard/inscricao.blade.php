@extends('layouts.dash')
@section('title', 'Busqueda')


@section('content')
<div class="busqueda_box">

    <div class="row">
        <h1>Tokens: {{ $tokens['total'] }}</h1>
    </div>
    <br>
    <form id="busca-form">
        @csrf
        <table class="table">
            <thead>
                <tr>
                    <td>Inscrição:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="numeroPadron" id="numeroPadron" style="width: 200px;" maxlength="14" placeholder="xx.xx.xxx.xxxx" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-success" type="button" id="buscar">Buscar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
    <div style="margin-top: 80px;" id="resultado" class="resultado_card">

    </div>
</div>


<script>
    $(document).ready(function() {
        $('#buscar').click(function() {
            let numeroPadron = $('#numeroPadron').val();

            if (numeroPadron) {
                $.get('/search/' + numeroPadron, function(response) {
                    let data = response.data;

                    if (response.resultados != 'Nao tem saldo suficiente') {
                        $('#resultado').html('<p>Propietario: ' + data.nome + '</p>' +
                            '<p>CPF/CNPJ: ' + data.doc + '</p>' +
                            '<p>Endereço: ' + data.endereco + '</p>');
                    } else {
                        $('#resultado').html('<p>' + response.resultados + '</p>');
                    }


                }).fail(function() {
                    $('#resultado').html('Error al obtener el valor.');
                });
            } else {
                $('#resultado').html('Por favor, ingresa un número de padron antes de buscar.');
            }
        });

        $('#numeroPadron').on('input', function() {
            let inputValue = $(this).val().replace(/\./g, '');
            inputValue = inputValue.replace(/\D/g, '');

            if (inputValue.length >= 2) {
                inputValue = inputValue.replace(/^(\d{2})/, '$1.');
            }
            if (inputValue.length >= 4) {
                inputValue = inputValue.replace(/(\d{2})(\d{3})/, '$1.$2.');
            }
            if (inputValue.length >= 7) {
                inputValue = inputValue.replace(/(\d{2})(\d{3})(\d{3})/, '$1.$2.$3.');
            }

            inputValue = inputValue.slice(0, 14);

            $(this).val(inputValue);
        });
    });
</script>

@endsection