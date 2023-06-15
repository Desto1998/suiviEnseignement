<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Matieres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class CoursController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api');
    }

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
        $validator = Validator::make($request->all() ,[
            'duree' => 'required|integer',
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required|date',
            'date_fin' => 'required|date',
            'enseignant_id' => 'required|integer',
            'matiere_id' => 'required|integer',
            'filiere_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }

        $data = Cours::create([
            'duree' => $request->duree,
            'libelle' => $request->libelle,
            'date_debut' => $request->date_debut,
            'date_fin' => $request->date_fin,
            'enseignant_id' => $request->enseignant_id,
            'matiere_id' => $request->matiere_id,
            'filiere_id' => $request->filiere_id,
        ]);
        $history = HistoriquesController::save('Creation','Cours','Creeation du cours', $data->cours_id, Auth::user()->id);
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
        $validator = Validator::make($request->all() ,[
            'duree' => 'required',
            'libelle' => 'required|string|max:255',
            'date_debut' => 'required',
            'date_fin' => 'required',
            'enseignant_id' => 'required',
            'matiere_id' => 'required',
            'filiere_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }

        $cours = Cours::find($id);
        $cours->duree = $request->duree;
        $cours->libelle = $request->libelle;
        $cours->date_debut = $request->date_debut;
        $cours->date_fin = $request->date_fin;
        $cours->enseignant_id = $request->enseignant_id;
        $cours->matiere_id = $request->matiere_id;
        $cours->filiere_id = $request->filiere_id;
        $cours->save();
        $history = HistoriquesController::save('Modification','Cours',"Modification du cours", $id, Auth::user()->id);
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
        $history = HistoriquesController::save('Suppression','Cours',"Supression du cours", $id, Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'message' => 'supprimee avec success',
            'matiere' => $cours,
        ]);
    }
}
