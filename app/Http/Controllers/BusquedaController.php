<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proprietario; // Reemplaza 'TuModelo' con el nombre de tu modelo real
use App\Models\Tokens;
use Illuminate\Support\Facades\Auth;

class BusquedaController extends Controller
{

    public function index()
    {
        return view("buscar");
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

    public function search($inscr)
    {
        // Obtén el número de padron del formulario
        $numeroPadron = $inscr;

        // Obtiene el usuario autenticado actual
        $usuarioAutenticado = Auth::user();

        $userid = $usuarioAutenticado->id;

        $token = Tokens::where('user_id', $userid)->first();

        if ($token->total > 0) {
            // Realiza la búsqueda en la base de datos
            $resultado = Proprietario::where('Imovel', 'like', $numeroPadron . '%')->first();

            if ($resultado) {
                $nome = $resultado->Nome;
                $doc = $resultado->Documento;
                $endereco = $resultado->Endereco;

                $data = [
                    'nome' => $nome,
                    'doc' => $doc,
                    'endereco' => $endereco
                ];
                $total = $token->total - 1;
                $gasto = $token->gasto + 1;
                // Actualizar la columna "gasto" con el nuevo valor
                $token->total = $total;
                $token->gasto = $gasto;

                // Guardar los cambios en la base de datos
                $token->save();

                // Devuelve los resultados como JSON
                return response()->json(['data' => $data]);
            } else {
                return response()->json(['resultados' => 'No se encontraron resultados.']);
            }
        } else {
            return response()->json(['resultados' => 'Nao tem saldo suficiente']);
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
