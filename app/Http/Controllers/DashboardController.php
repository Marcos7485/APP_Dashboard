<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Tokens;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        if (auth()->check()) {
            // Obtener el usuario autenticado y seleccionar las columnas específicas
            $usuario = auth()->user();

            $coins = tokens::where('user_id', $usuario->id)->get();

            $user = [
                'email' => $usuario->email,
                'creci' => $usuario->creci,
                'name' => $usuario->name,
                'date' => $usuario->email_verified_at,
            ];

            $tokens = [
                'gasto' => $coins[0]->gasto,
                'comprado' => $coins[0]->comprado,
                'total' => $coins[0]->total,
            ];

            return view('dashboard.perfil', ['datos' => $user, 'tokens' => $tokens]);
        } else {
            return redirect()->route('/');
        }
    }


    public function inscr()
    {
        if (auth()->check()) {
            // Obtener el usuario autenticado y seleccionar las columnas específicas
            $usuario = auth()->user();

            $coins = tokens::where('user_id', $usuario->id)->get();

            $tokens = [
                'gasto' => $coins[0]->gasto,
                'comprado' => $coins[0]->comprado,
                'total' => $coins[0]->total,
            ];

            return view('dashboard.inscricao', ['tokens' => $tokens]);
        } else {
            return redirect()->route('/');
        }
    }

    public function predio()
    {
        if (auth()->check()) {
            // Obtener el usuario autenticado y seleccionar las columnas específicas
            $usuario = auth()->user();

            $coins = tokens::where('user_id', $usuario->id)->get();

            $tokens = [
                'gasto' => $coins[0]->gasto,
                'comprado' => $coins[0]->comprado,
                'total' => $coins[0]->total,
            ];

            return view('dashboard.predio', ['tokens' => $tokens]);
        } else {
            return redirect()->route('/');
        }
    }
}
