<?php

namespace App\Http\Controllers;

use App\Models\Experience;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class ExperienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('manage', Experience::class);
        $experiences = \App\Models\Experience::orderBy('date_debut', 'desc')->get();

        return Inertia::render('experiences/index',
        [
            'experiences' => $experiences
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
        Gate::authorize('manage', Experience::class);
        $validated = $request->validate([
            'poste' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'description' => 'nullable|string',
        ]);

        \App\Models\Experience::create($validated);
        return redirect()->route('experiences.index')
            ->with('success', 'Expérience ajoutée avec succès!');
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
    public function edit(Experience $experience)
    {
        Gate::authorize('manage', Experience::class);
        return Inertia::render('experiences/edit', [
            'experience' => $experience
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Experience $experience)
    {
        Gate::authorize('manage', Experience::class);
        $validated = $request->validate([
            'poste' => 'required|string|max:255',
            'entreprise' => 'required|string|max:255',
            'lieu' => 'required|string|max:255',
            'type' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'nullable|date|after_or_equal:date_debut',
            'description' => 'nullable|string',
        ]);

        $experience->update($validated);

        return redirect()->route('experiences.index')
            ->with('success', 'Expérience mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('manage', Experience::class);
        $experience = \App\Models\Experience::findOrFail($id);
        $experience->delete();

        return redirect()->route('experiences.index')
            ->with('success', 'Expérience supprimée avec succès!');
    }
}
