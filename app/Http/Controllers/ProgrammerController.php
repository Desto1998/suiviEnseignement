<?php

namespace App\Http\Controllers;

use App\Models\Cours;
use App\Models\Historiques;
use App\Models\Matieres;
use App\Models\Programmer;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;

class ProgrammerController extends Controller
{
    //
    public function index()
    {
        $data = Programmer::where('deleted_at', null)->orderBy('programmer_id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            'heure_debut' => 'required',
            'heure_fin' => 'required',
            'description' => 'required|string|max:255',
            'nombre_heure' => 'required',
            'date_passage' => 'required',
            'est_dispenser' => 'required',
            //'salle_id ' => 'required|integer',
            'cours_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }

        $data = Programmer::create([
            'heure_debut' => $request->heure_debut,
            'heure_fin' => $request->heure_fin,
            'description' => $request->description,
            'nombre_heure' => $request->nombre_heure,
            'date_passage' => $request->date_passage,
            'est_dispenser' => 0,
            'cours_id' => $request->cours_id,
            'salle_id' => $request->salle_id,
        ]);
        $history = HistoriquesController::save('Creation','Programmer',"Programmation du cours",$data->programmer_id, Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Programmer created successfully',
            'programmer' => $data,
        ]);
    }

    public function show($id)
    {
        $programmer = Programmer::find($id);
        return response()->json([
            'status' => 'success',
            'programmer' => $programmer,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all() ,[
            'heure_debut' => 'required',
            'description' => 'required|string|max:255',
            'heure_fin' => 'required',
            'nombre_heure' => 'required',
            'date_passage' => 'required',
            'est_dispenser' => 'required',
            'cours_id' => 'required|integer',
            //'salle_id' => 'required|integer',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }

        $data = Programmer::find($id);
        $data->heure_debut = $request->heure_debut;
        $data->heure_fin = $request->heure_fin;
        $data->nombre_heure = $request->nombre_heure;
        $data->date_passage = $request->date_passage;
        $data->description = $request->description;
        $data->est_dispenser = $request->est_dispenser;
        $data->cours_id = $request->cours_id;
        $data->salle_id = $request->salle_id;
        $data->save();
        $history = HistoriquesController::save('Modification','Programmer',"Modification du cours programmer",$id, Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'message' => 'Modifier',
            'cours' => $data,
        ]);
    }

    public function destroy($id)
    {
        $programmer = Programmer::find($id);
        $programmer->deleted_at = date('Y-m-d H:i:s');
        $programmer->save();
        $history = HistoriquesController::save('Suppression','Programmer',"Suppression du cours programmer",$id, Auth::user()->id);
        return response()->json([
            'status' => 'success',
            'message' => 'supprimee avec success',
            'programmer' => $programmer,
        ]);
    }
}
