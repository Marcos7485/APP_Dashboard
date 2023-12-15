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
            return redirect()->route('dashboard');
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












    public function adicionar()
    {

        $jsonString = file_get_contents('../Parte_9.json');
        $data = json_decode($jsonString, true);


        foreach ($data as $item) {
            $propiedad = new Propiedad();
            $propiedad->Contribuinte = $item['Codigo'];
            $propiedad->Nome = $item['Nome'];
            $propiedad->Documento = $item['CPF/CNPJ'];
            $propiedad->Id_imov = $item['Id_imov'];
            $propiedad->Imovel = $item['Imovel'];
            $propiedad->Endereco = $item['Endereco'];
            $propiedad->save();
        }
        die('Pronto9');
    }

}
