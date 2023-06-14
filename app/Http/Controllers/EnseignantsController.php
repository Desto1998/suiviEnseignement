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
        $data = Enseignants::where('deleted_at',null)->orderBy('enseignant_id', 'desc')->get();
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
        $history = (new HistoriquesController())->save('Creation','Cration',"Creation de l'esnseignant , id: $data->enseignant_id", $data->enseignant_id);
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

        $enseignant = Enseignants::find($id);
        $enseignant->nom = $request->nom;
        $enseignant->email = $request->email;
        $enseignant->prenom = $request->prenom;
        $enseignant->matricule = $request->matricule;
        $enseignant->tel = $request->tel;
        $enseignant->save();
        $history = (new HistoriquesController())->save('Modification','Enseignant',"Modification de l'esnseignant , id: $id",$id);
        return response()->json([
            'status' => 'success',
            'message' => 'Enseignant updated successfully',
            'enseignant' => $enseignant,
        ]);
    }

    public function destroy($id)
    {
        $enseignant = Enseignants::find($id);
        $enseignant->deleted_at = date('Y-m-d H:i:s');
        $enseignant->save();
        $history = (new HistoriquesController())->save('Suppression','Enseignant',"Suppression de l'esnseignant , id: $id",$id);
        return response()->json([
            'status' => 'success',
            'message' => 'Enseignant deleted successfully',
            'enseignant' => $enseignant,
        ]);
    }
}
