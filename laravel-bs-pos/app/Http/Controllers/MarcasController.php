<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreMarcasRequest;
use App\Http\Requests\UpdateMarcasRequest;
use App\Models\Caracteristica;
use App\Models\Marca;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MarcasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $marcas = Marca::with('caracteristica')->latest()->get();

        return view ('marcas.index', ['marcas' => $marcas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('marcas.create');

    }

    /**
     * Store a newly created resource in storage.
     */
public function store(StoreMarcasRequest $request)
{
    try {
        DB::beginTransaction();
        $caracteristica = Caracteristica::create($request->validated());
        $caracteristica->marca()->create([
            'caracteristica_id' => $caracteristica->id
        ]);
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Error al registrar la marca']);
    }

    return redirect()->route('marcas.index')->with('success', 'Marca Registrada');
}


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Marca $marca)
    {
        return view('marcas.edit', ['marca'=>$marca]);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateMarcasRequest $request, Marca $marca)
    {
        Caracteristica::where('id', $marca->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('marcas.index')->with('success', 'Marca Actualizada');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $message = '';
        $marca = Marca::find($id);
        if($marca->caracteristica->estado == 1) {
            Caracteristica::where('id',$marca->caracteristica->id)
            ->update(['estado' => 0]);
            $message = 'Marca Eliminada';
        } else {
            Caracteristica::where('id',$marca->caracteristica->id)
            ->update(['estado' => 1]);
            $message = 'Marca Restaurada';
        }

                return redirect()->route('marcas.index')->with('success', $message);

    }
}
