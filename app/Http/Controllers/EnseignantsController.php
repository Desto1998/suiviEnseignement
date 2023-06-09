<?php

namespace App\Http\Controllers;

use App\Models\Enseignants;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class EnseignantsController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth:api');
    }

    public function index()
    {
        $data = Enseignants::all();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'tel' => 'required|max:255',
        ]);

        $data = Enseignants::create([
            'nom' => $request->nom,
            'email' => $request->email,
            'prenom' => $request->prenom,
            'matricule' => $request->matricule,
            'tel' => $request->tel,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Enseignant created successfully',
            'enseignant' => $data,
        ]);
    }

    public function show($id)
    {
        $enseignant = Enseignants::find($id);
        return response()->json([
            'status' => 'success',
            'enseignant' => $enseignant,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nom' => 'required|string|max:255',
            'email' => 'required|string|max:255',
            'prenom' => 'required|string|max:255',
            'matricule' => 'required|string|max:255',
            'tel' => 'required|max:255',
        ]);

        $enseignant = User::find($id);
        $enseignant->nom = $request->nom;
        $enseignant->email = $request->email;
        $enseignant->prenom = $request->prenom;
        $enseignant->matricule = $request->matricule;
        $enseignant->tel = $request->tel;
        $enseignant->save();

        return response()->json([
            'status' => 'success',
            'message' => 'Enseignant updated successfully',
            'enseignant' => $enseignant,
        ]);
    }

    public function destroy($id)
    {
        $enseignant = Enseignants::find($id);
        $enseignant->delete();

        return response()->json([
            'status' => 'success',
            'message' => 'Enseignant deleted successfully',
            'enseignant' => $enseignant,
        ]);
    }
}
