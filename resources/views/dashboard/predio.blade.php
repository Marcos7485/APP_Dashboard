@extends('layouts.dash')
@section('title', 'Búsqueda de predio')

@section('content')
<div class="busqueda_box">
    <form id="busca-form" action="/predio" method="POST">
        @csrf <!-- Token CSRF -->
        @method('POST') <!-- Método HTTP -->

        <table class="table">
            <thead>
                <tr>
                    <td>Inscrição do prédio:</td>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>
                        <input type="text" name="numeroPredio" id="numeroPadron" style="width: 200px;" maxlength="14" placeholder="xx.xx.xxx.xxxx" required>
                    </td>
                </tr>
                <tr>
                    <td>
                        <button class="btn btn-success" type="submit" id="buscar">Buscar</button>
                    </td>
                </tr>
            </tbody>
        </table>
    </form>
</div>

<script>
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
</script>
@endsection