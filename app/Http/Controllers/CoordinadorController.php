<?php

namespace App\Http\Controllers;

use App\Models\Coordinador;
use App\Models\Persona;
use App\Models\Contacto;
use Illuminate\Http\Request;

class CoordinadorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coordinadores= Coordinador::all();
        return view('coordinador.index',['coordinadores'=>$coordinadores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('coordinador.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nombre' => 'required',
            'ape_pat' => 'required',
            'ape_mat' => 'required',
            'titulo' => 'required',
            'puesto' => 'required',
            'telefono_fijo' => 'required',
            'celular' => 'required',
            'telefono_ref' => 'required',
            'correo' => 'required|email',
        ]);

        // Crear y guardar el registro de la persona
        $persona = new Persona();
        $persona->nombre = $request->input('nombre');
        $persona->ape_pat = $request->input('ape_pat');
        $persona->ape_mat = $request->input('ape_mat');
        $persona->titulo = $request->input('titulo');
        $persona->save();

    // Crear y guardar el registro de contacto
        $contacto = new Contacto();
        $contacto->telefono_fijo = intval($request->input('telefono_fijo'));
        $contacto->celular = intval($request->input('celular'));
        $contacto->telefono_ref = intval($request->input('telefono_ref'));
        $contacto->correo = $request->input('correo');
        $contacto->save();

    // Crear y guardar el registro del coordinador relacionado con la persona y el contacto
        $coordinador = new Coordinador();
        $coordinador->id_persona = $persona->id; // Asignar el ID de la persona creada
        $coordinador->puesto = $request->input('puesto');
        $coordinador->id_contacto = $contacto->id; // Asignar el ID del contacto creado
        $coordinador->save();

        return view("coordinador.message",['msg' => "Registro guardado"]);

    }

    /**
     * Display the specified resource.
     */
    public function show(Coordinador $coordinador)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $coordinador= Coordinador::find($id);
        return view('coordinador.edit',['coordinador'=>$coordinador,'persona'=>Persona::all(),'contacto'=>Contacto::all()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'nombre' => 'required',
            'ape_pat' => 'required',
            'ape_mat' => 'required',
            'titulo' => 'required',
            'puesto' => 'required',
            'telefono_fijo' => 'required',
            'celular' => 'required',
            'telefono_ref' => 'required',
            'correo' => 'required|email',
        ]);

        // Crear y guardar el registro de la persona
        $persona = Persona::find($id);
        $persona->nombre = $request->input('nombre');
        $persona->ape_pat = $request->input('ape_pat');
        $persona->ape_mat = $request->input('ape_mat');
        $persona->titulo = $request->input('titulo');
        $persona->save();

    // Crear y guardar el registro de contacto
        $contacto = Contacto ::find($id);
        $contacto->telefono_fijo = intval($request->input('telefono_fijo'));
        $contacto->celular = intval($request->input('celular'));
        $contacto->telefono_ref = intval($request->input('telefono_ref'));
        $contacto->correo = $request->input('correo');
        $contacto->save();

    // Crear y guardar el registro del coordinador relacionado con la persona y el contacto
        $coordinador = Coordinador::find($id);
        $coordinador->id_persona = $persona->id; // Asignar el ID de la persona creada
        $coordinador->puesto = $request->input('puesto');
        $coordinador->id_contacto = $contacto->id; // Asignar el ID del contacto creado
        $coordinador->save();

        return view("coordinador.message",['msg' => "Registro actualizado"]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coordinador = Coordinador::find($id);
        $persona = $coordinador->persona;
        $contacto = $coordinador->contacto;

        $coordinador->delete();
        $persona->delete();
        $contacto->delete();

        return redirect("coordinador");
    }

}
