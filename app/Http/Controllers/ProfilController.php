<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Storage;

class ProfilController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = $request->user();
        if (!$user) {
            abort(403);
        }

        $profil = $user->admin === true
            ? Profil::first()
            : Profil::where('user_id', $user->id)->first();

        if ($profil) {
            Gate::authorize('manage', $profil);
        } else {
            Gate::authorize('create', Profil::class);
        }

        return inertia('profil/index', [
            'profil' => $profil,
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
        Gate::authorize('create', Profil::class);
        $photoRules = ['nullable', 'string', 'max:255'];
        if ($request->hasFile('profil_photo')) {
            $photoRules = ['nullable', 'file', 'image', 'max:2048'];
        }

        $cvRules = ['nullable', 'string', 'max:255'];
        if ($request->hasFile('cv')) {
            $cvRules = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'bio' => 'required|string',
            'profil_photo' => $photoRules,
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'disponibilite' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'cv' => $cvRules,
            'cv_path' => 'nullable|string|max:255',
        ]);

        $attributes = $validated;
        $attributes['user_id'] = $request->user()?->id;

        if ($request->hasFile('profil_photo')) {
            $attributes['profil_photo'] = $request->file('profil_photo')->store('profils', 'public');
        }

        if ($request->hasFile('cv')) {
            $attributes['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        unset($attributes['cv']);

        $profil = new Profil();
        $profil->forceFill($attributes)->save();

        return redirect()->route('profil.index')
            ->with('success', 'Profil créé avec succès!');
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
        $profil = Profil::findOrFail($id);
        Gate::authorize('manage', $profil);

        $photoRules = ['nullable', 'string', 'max:255'];
        if ($request->hasFile('profil_photo')) {
            $photoRules = ['nullable', 'file', 'image', 'max:2048'];
        }

        $cvRules = ['nullable', 'string', 'max:255'];
        if ($request->hasFile('cv')) {
            $cvRules = ['nullable', 'file', 'mimes:pdf', 'max:10240'];
        }

        $validated = $request->validate([
            'nom' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'titre' => 'required|string|max:255',
            'bio' => 'required|string',
            'profil_photo' => $photoRules,
            'email' => 'nullable|email|max:255',
            'telephone' => 'nullable|string|max:20',
            'adresse' => 'nullable|string|max:255',
            'disponibilite' => 'nullable|string|max:255',
            'linkedin' => 'nullable|string|max:255',
            'github' => 'nullable|string|max:255',
            'cv' => $cvRules,
            'cv_path' => 'nullable|string|max:255',
        ]);

        $attributes = $validated;

        if ($request->hasFile('profil_photo')) {
            if (!empty($profil->profil_photo)) {
                Storage::disk('public')->delete($profil->profil_photo);
            }

            $attributes['profil_photo'] = $request->file('profil_photo')->store('profils', 'public');
        } else {
            $incomingPhoto = $attributes['profil_photo'] ?? null;
            if ($incomingPhoto === null || $incomingPhoto === '') {
                unset($attributes['profil_photo']);
            }
        }

        if ($request->hasFile('cv')) {
            if (!empty($profil->cv_path)) {
                Storage::disk('public')->delete($profil->cv_path);
            }

            $attributes['cv_path'] = $request->file('cv')->store('cvs', 'public');
        }

        unset($attributes['cv']);

        $profil->forceFill($attributes)->save();

        return redirect()->route('profil.index')
            ->with('success', 'Profil mis à jour avec succès!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $profil = \App\Models\Profil::findOrFail($id);
        Gate::authorize('manage', $profil);
        $profil->delete();
        return redirect()->route('profil.index')
            ->with('success', 'Profil supprimé avec succès!');
    }
}
