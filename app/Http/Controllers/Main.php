<?php

namespace App\Http\Controllers;

use App\Models\Propiedad;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Main extends Controller
{

    public function index()
    {
        if (auth()->check()) {
            return redirect()->route('dashboard'); // Si el usuario está autenticado, redirige al dashboard
        } else {
            return view('auth.login'); // Si el usuario no está autenticado, carga la vista de login
        }
    }

    public function login(Request $request)
    {
        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            // La autenticación fue exitosa
            return redirect()->route('dashboard.perfil');
        }

        // La autenticación falló
        return back()->withInput()->withErrors(['error' => 'Credenciales inválidas']);
    }
    
    public function logout(Request $request) {
        Auth::logout(); // Cierra la sesión del usuario
        $request->session()->invalidate(); // Invalida la sesión existente
        $request->session()->regenerateToken(); // Regenera el token de sesión
    
        return redirect('/'); // Redirige a la página principal u otra página deseada
    }

    public function inscr()
    {
        return view('busca_inscr');
    }

    public function predio()
    {
        return view('busca_predio');
    }










    // public function adicionar()
    // {

    //     $jsonString = file_get_contents('../datos_divididos_9.json');
    //     $data = json_decode($jsonString, true);


    //     foreach ($data as $item) {
    //         $propiedad = new Propiedad();
    //         $propiedad->Contribuinte = $item['Codigo'];
    //         $propiedad->Nome = $item['Nome'];
    //         $propiedad->Documento = $item['CPF/CNPJ'];
    //         $propiedad->Id_imov = json_encode($item['Id_imov']);
    //         $propiedad->Imovel = json_encode($item['Imovel']);
    //         $propiedad->Endereco = json_encode($item['Endereco']);
    //         $propiedad->save();
    //     }
    //     die('Pronto');
    // }

}
