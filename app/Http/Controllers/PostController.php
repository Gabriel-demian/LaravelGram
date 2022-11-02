<?php

namespace App\Http\Controllers;

use App\Models\Post;
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

        //$posts = Post::where('user_id', $user->id)->get(); // trae todos los posts con esos id
        $posts = Post::where('user_id', $user->id)->paginate(8);

        return view('layouts.dashboard', [
            'user' => $user,
            'posts'=> $posts
        ]);
    }

    public function create(){
        return view('posts.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'titulo' => 'required|max:255',
            'descripcion' => 'required',
            'imagen' => 'required'
        ]);
        
        //Forma 1
        //Post::create([
        //    'titulo' => $request->titulo,
        //    'descripcion' => $request->descripcion,
        //    'imagen' => $request->imagen,
        //    'user_id' => auth()->user()->id  //ya que el usuario que está creando el post es el que está autentificado
        //]);

        //Forma 2
        //$post = new Post;
        //$post->titulo = $request->titulo;
        //$post->descripcion = $request->descripcion;
        //$post->imagen = $request->imagen;
        //$post->user_id = auth()->user()->id;
        //$post->save();

        //Forma 3
        $request->user()->posts()->create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'imagen' => $request->imagen,
            'user_id' => auth()->user()->id 
        ]);

        return redirect()->route('post.index', auth()->user()->username);
    }

    public function show(){
        return view('');
    }
}
