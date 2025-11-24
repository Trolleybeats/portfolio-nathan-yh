<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TechnologieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){
        $technologies = \App\Models\Technologie::orderBy('nom')->get();

        return Inertia::render('technologies/index',
        [
            'technologies' => $technologies
        ]);
    }
    
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
        ]);

        // Obtenir le prochain ordre d'affichage
        $nextOrdre = \App\Models\Technologie::max('ordre_affichage') + 1;
        
        $validated['ordre_affichage'] = $nextOrdre;

        \App\Models\Technologie::create($validated);

        return redirect()->route('technologies.index')
            ->with('success', 'Technologie ajoutée avec succès!');
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
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $technologie = \App\Models\Technologie::findOrFail($id);
        $technologie->delete();

        return redirect()->route('technologies.index')
            ->with('success', 'Technologie supprimée avec succès!');
    }
}
