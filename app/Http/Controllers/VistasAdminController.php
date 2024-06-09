<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Anuncios;

class VistasAdminController extends Controller
{
    public function mostrarIndex()
    {
        return view('VistasAdministrador.inicioAdmin');
    }
    

}
