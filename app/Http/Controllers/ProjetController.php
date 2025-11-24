<?php

namespace App\Http\Controllers;

use App\Models\Projet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ProjetController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Projet $projet)
    {
        Gate::authorize('manage', $projet);

        $projets = \App\Models\Projet::orderBy('ordre_affichage')->get();
        
        return Inertia::render('projets/index', [
            'projets' => $projets
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Projet $projet)
    {
        Gate::authorize('manage', $projet);

        $technologies = \App\Models\Technologie::orderBy('nom')->get();

        return Inertia::render('projets/create', [
            'technologies' => $technologies
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, Projet $projet)
    {
        Gate::authorize('manage', $projet);
        $validated=$request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projets,slug',
            'description_courte' => 'required|string|max:255',
            'description_longue' => 'nullable|string',
            'type' => 'required|string|max:255',
            'statut' => 'required|string|max:255',
            'date' => 'required|date',
            'client' => 'required|string|max:255',
            'contexte' => 'required|string|max:255',
            'duree' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'projet_url' => 'required|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'ordre_affichage' => 'required|integer',
            'technologies' => 'nullable|array',
            'technologies.*' => 'exists:technologies,id',
        ]);

        $projet = \App\Models\Projet::create($validated);

        if ($request->has('technologies')) {
            $projet->technologies()->attach($request->technologies);
        }

        return redirect()->route('projets.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(Projet $projet)
    {
        Gate::authorize('manage',$projet);
        
        return Inertia::render('projets/show', [
            'projet' => $projet,
            'technologies' => $projet->technologies,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Projet $projet)
    {
        Gate::authorize('manage',$projet);
        
        return Inertia::render('projets/edit', [
            'projet' => $projet
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Projet $projet)
    {

        Gate::authorize('manage',$projet);

        $validated=$request->validate([
            'titre' => 'required|string|max:255',
            'slug' => 'required|string|max:255|unique:projets,slug,'.$id,
            'description_courte' => 'required|string|max:255',
            'description_longue' => 'nullable|string',
            'type' => 'required|string|max:255',
            'statut' => 'required|string|max:255',
            'date' => 'required|date',
            'client' => 'required|string|max:255',
            'contexte' => 'required|string|max:255',
            'duree' => 'nullable|string|max:255',
            'role' => 'nullable|string|max:255',
            'projet_url' => 'required|url|max:255',
            'github_url' => 'nullable|url|max:255',
            'ordre_affichage' => 'required|integer',
        ]);

        $projet->update($validated);

        return redirect()->route('projets.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Projet $projet)
    {
        Gate::authorize('manage',$projet);
        $projet->delete();

        return redirect()->route('projets.index')
        ->with ('success', 'Projet supprimé avec succès!');
    }
}
