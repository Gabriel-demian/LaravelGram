<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class PostController extends Controller
{
    //session_start() para inciar la sesion. que guarda los datos en ej: $_SESSION['email']

    // el contructor se ejecuta cuando es instanciado el controlador
    public function __construct()
    {
        //el middleware filtra solicitudes, 
        //el middleware auth se encarga es de ver que el usuario se encuentre con una sesion activa
        $this->middleware('auth');
    }

    public function index(User $user){
        return view('layouts.dashboard', [
            'user' => $user
        ]);
    }

    public function create(){
        return view('posts.create');
    }
}
