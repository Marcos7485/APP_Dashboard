<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proprietario; // Reemplaza 'TuModelo' con el nombre de tu modelo real

class BusquedaController extends Controller
{

    public function index()
    {
        return view("buscar");
    }

    public function terreno($inscr)
    {
        // Obtén el número de padron del formulario
        $numeroPadron = $inscr;

        // Realiza la búsqueda en la base de datos
        $resultado = Proprietario::where('Imovel', 'like', '%' . $numeroPadron . '.001%')->first();

        if ($resultado) {
            $nome = $resultado->Nome;
            $doc = $resultado->Documento;
            $imov = json_decode($resultado->Imovel, true);
            $imov_id = json_decode($resultado->Id_imov, true);
            $endereco = json_decode($resultado->Endereco, true);

            // Devuelve los resultados como JSON
            return response()->json(['resultados' => [$nome, $doc, $imov, $imov_id, $endereco]]);
        } else {
            return response()->json(['resultados' => 'No se encontraron resultados.']);
        }
    }

    public function predio(Request $request)
    {
        // Obtén el número de padron del formulario
        $numeroPadron = $request->input('numeroPredio');

        // Realiza la búsqueda en la base de datos
        $resultado = Proprietario::where('Imovel', 'like', '%' . $numeroPadron . '%')->get();
        $enderecos = [];
        $inscr = [];

        if ($resultado) {
            $inscrExistente = [];

            foreach ($resultado as $items) {
                $endereco = json_decode($items->Endereco, true);
                $imovel = json_decode($items->Imovel, true);
                $imovelId = $endereco[0]; // Suponiendo que el ID de la inscripción está en la primera posición del array $imovel

                // Verificar si el número de inscripción ya existe
                if (!isset($inscrExistente[$imovelId])) {
                    array_push($enderecos, $endereco);
                    array_push($inscr, $imovel);

                    // Agregar el número de inscripción al array de inscripciones existentes para evitar duplicados
                    $inscrExistente[$imovelId] = true;
                }
            }
            $data = [
                'resultados' => $enderecos,
                'inscr' => $inscr
            ];

            // Devuelve los resultados como JSON
            return view('predio', compact('data'));
        } else {
            return response()->json(['resultados' => 'No se encontraron resultados.']);
        }
    }

    public function info($inscr)
    {
        // Obtén el número de padron del formulario
        $numeroPadron = base64_decode($inscr);

        // Verificar si la cadena comienza con $
        if (strpos($numeroPadron, '$') === 0) {
            // Eliminar el primer carácter (símbolo $)
            $numeroPadron = substr($numeroPadron, 1);
        }
        // Realiza la búsqueda en la base de datos
        $resultado = Proprietario::where('Imovel', 'like', '%' . $numeroPadron . '%')->first();

        if ($resultado) {
            $nome = $resultado->Nome;
            $doc = $resultado->Documento;
            $endereco = json_decode($resultado->Endereco, true);

            $data = [
                'nome' => $nome,
                'doc' => $doc,
                'endereco' => $endereco
            ];
            // Devuelve los resultados como JSON
            return view('propietario', compact('data'));
        } else {
            return response()->json(['resultados' => 'No se encontraron resultados.']);
        }
    }

    public function endereco($endereco)
    {

        // Realiza la búsqueda en la base de datos
        $resultado = Proprietario::where('Endereco', 'like', '%' . $endereco . '%')->first();

        if ($resultado) {
            // Devuelve los resultados como JSON
            return response()->json(['resultados' => $resultado]);
        } else {
            return response()->json(['resultados' => 'No se encontraron resultados.']);
        }
    }
}
