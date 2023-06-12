<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matieres;
use Illuminate\Http\Request;

class CoursController extends Controller
{
    //

    public function index()
    {
        $data = Cours::where('deleted_at', null)->orderBy('cours_id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'duree' => 'required',
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'enseignant_id' => 'required',
            'matiere_id' => 'required',
            'filiere_id' => 'required',
        ]);

        $data = Cours::create([
            'duree' => $request->duree,
            'libelle' => $request->libelle,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'enseignant_id' => $request->enseignant_id,
            'matiere_id' => $request->matiere_id,
            'filiere_id' => $request->filiere_id,
        ]);
        $history = (new HistoriquesController())->save('Creation','Cours',"Creeation du cours , id: $data->cours_id",$data->cours_id);
        return response()->json([
            'status' => 'success',
            'message' => 'Cours created successfully',
            'matiere' => $data,
        ]);
    }

    public function show($id)
    {
        $cours = Cours::find($id);
        return response()->json([
            'status' => 'success',
            'cours' => $cours,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'duree' => 'required',
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'enseignant_id' => 'required',
            'matiere_id' => 'required',
            'filiere_id' => 'required',
        ]);

        $cours = Cours::find($id);
        $cours->duree = $request->duree;
        $cours->libelle = $request->libelle;
        $cours->date_debut = $request->date_debut;
        $cours->date_fin = $request->date_fin;
        $cours->enseignant_id = $request->enseignant_id;
        $cours->matiere_id = $request->matiere_id;
        $cours->filiere_id = $request->filiere_id;
        $cours->save();
        $history = (new HistoriquesController())->save('Modification','Cours',"Modification du cours , id: $id",$id);
        return response()->json([
            'status' => 'success',
            'message' => 'Le cours a ete modifie.',
            'cours' => $cours,
        ]);
    }

    public function destroy($id)
    {
        $cours = Cours::find($id);
        $cours->deleted_at = date('Y-m-d H:i:s');
        $cours->save();
        $history = (new HistoriquesController())->save('Suppression','Cours',"Supression du cours , id: $id",$id);
        return response()->json([
            'status' => 'success',
            'message' => 'supprimee avec success',
            'matiere' => $cours,
        ]);
    }
}
