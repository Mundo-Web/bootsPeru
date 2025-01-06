<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreGeneralRequest;
use App\Http\Requests\UpdateGeneralRequest;
use App\Models\General;
use Illuminate\Http\Request;


class GeneralController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //llames a los registros para mostrarlos en tabla
        
        
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //El formjulario para crear
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGeneralRequest $request)
    {
        //este es el proceso que crea
    }

    /**
     * Display the specified resource.
     */
    public function show(General $general)
    {
        //este es el que muestra
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(General $general)
    {
        //El que muestra el form para editar
        //return "mostrar el unico registro";
    
        $general = General::find(1);

        // if (!$general) {
        //     return redirect()->back()->with('error', 'El registro no existe');
        // }

        
        return view('pages.general.edit', compact('general'));
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
            
            $general = General::findOrfail($id); 

            // Actualizar los campos del registro con los datos del formulario
           $data = $request->all();
            
            if($request->has('pago_contra_entrega')){
                $general->pago_contra_entrega = true;
                $data['pago_contra_entrega'] = true;
            }else{
                $general->pago_contra_entrega = false;
                $data['pago_contra_entrega'] = false;
            }

            $general->update($data);
            // Guardar 
            $general->save();  

            return back()->with('success', 'Registro actualizado correctamente');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(General $general)
    {
        //Este es el proceso que borra
    }
}
