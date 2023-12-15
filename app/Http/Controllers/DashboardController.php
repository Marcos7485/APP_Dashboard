<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        if (auth()->check()) {
            return view('dashboard.perfil');
        } else {
            return redirect()->route('/');
        }
    }

    public function inscr()
    {   
        if (auth()->check()) {
            return view('dashboard.inscricao');
        } else {
            return redirect()->route('/');
        }
    }

    public function predio()
    {
        if (auth()->check()) {
            return view('dashboard.predio');
        } else {
            return redirect()->route('/');
        }
    }
}
