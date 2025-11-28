<?php

namespace App\Http\Controllers;

use App\Models\Education;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Inertia\Inertia;

class EducationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        Gate::authorize('manage', Education::class);
        $educations = \App\Models\Education::orderBy('date_obtention', 'desc')->get();

        return Inertia::render('education/index',
        [
            'educations' => $educations
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
        Gate::authorize('manage', Education::class);
        $validated = $request->validate([
            'diplome' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'date_obtention' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        \App\Models\Education::create($validated);
        return redirect()->route('education.index')
            ->with('success', 'Éducation ajoutée avec succès!');
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
    public function edit (Education $education)
    {
        Gate::authorize('manage', Education::class);
        return Inertia::render('education/edit', [
            'education' => $education
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Education $education)
    {
        Gate::authorize('manage', Education::class);
        $validated = $request->validate([
            'diplome' => 'required|string|max:255',
            'etablissement' => 'required|string|max:255',
            'date_obtention' => 'nullable|date',
            'description' => 'nullable|string',
        ]);

        $education->update($validated);

        return redirect()->route('education.index')
            ->with('success', 'Éducation mise à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        Gate::authorize('manage', Education::class);
        $education = \App\Models\Education::findOrFail($id);
        $education->delete();

        return redirect()->route('education.index')
            ->with('success', 'Éducation supprimée avec succès!');
    }
}
