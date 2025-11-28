<?php

namespace App\Http\Controllers;

use App\Models\Technologie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class TechnologieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(){

        Gate::authorize('manage', Technologie::class);
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
        Gate::authorize('manage', Technologie::class);
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
    public function edit($id)
    {
        $technologie = Technologie::findOrFail($id);
        Gate::authorize('manage', $technologie);
        
        return Inertia::render('technologies/edit', [
            'technologie' => $technologie
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Technologie $technologie)
    {
        Gate::authorize('manage', $technologie);
        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'categorie' => 'required|string|max:255',
            'niveau' => 'required|string|max:255',
        ]);

        $technologie->update($validated);

        return redirect()->route('technologies.index')
            ->with('success', 'Technologie mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Technologie $technologie)
    {
        Gate::authorize('manage', $technologie);
        $technologie->delete();

        return redirect()->route('technologies.index')
            ->with('success', 'Technologie supprimée avec succès!');
    }
}
