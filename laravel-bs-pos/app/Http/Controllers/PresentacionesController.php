<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePresentacionesRequest;
use App\Http\Requests\UpdatePresentacionesRequest;
use App\Models\Caracteristica;
use App\Models\Presentacione;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PresentacionesController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $presentaciones = Presentacione::with('caracteristica')->latest()->get();

        return view ('presentaciones.index', ['presentaciones' => $presentaciones]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('presentaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePresentacionesRequest $request)
    {
    try {
        DB::beginTransaction();
        $caracteristica = Caracteristica::create($request->validated());
        $caracteristica->presentacione()->create([
            'caracteristica_id' => $caracteristica->id
        ]);
        DB::commit();
    } catch (Exception $e) {
        DB::rollBack();
        return redirect()->back()->withErrors(['error' => 'Error al registrar la presentación']);
    }

    return redirect()->route('presentaciones.index')->with('success', 'Presentación Registrada');
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
    public function edit(Presentacione $presentacione)
    {
                return view('presentaciones.edit', ['presentacione'=>$presentacione]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePresentacionesRequest $request, Presentacione $presentacione)
    {
        Caracteristica::where('id', $presentacione->caracteristica->id)
        ->update($request->validated());

        return redirect()->route('presentaciones.index')->with('success', 'Presentación Actualizada');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
       {
        $message = '';
        $presentacione = Presentacione::find($id);
        if($presentacione->caracteristica->estado == 1) {
            Caracteristica::where('id',$presentacione->caracteristica->id)
            ->update(['estado' => 0]);
            $message = 'Presentación Eliminada';
        } else {
            Caracteristica::where('id',$presentacione->caracteristica->id)
            ->update(['estado' => 1]);
            $message = 'Presentación Restaurada';
        }

                return redirect()->route('presentaciones.index')->with('success', $message);

    }
}
