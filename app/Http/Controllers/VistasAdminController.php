<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

use App\Models\Anuncios;

use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;

class VistasAdminController extends Controller
{
    
    public function verDescriptorPuestos(){

        $preguntas = Anuncios::all();

        return view('VistasAdministrador/descriptorPuestos', [

            'preguntasFrecuentes' => $preguntas
        ]);
        
    }

}
