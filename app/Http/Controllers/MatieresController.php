<?php

namespace App\Http\Controllers;

use App\Models\Matieres;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Exception;

class MatieresController extends Controller
{
    //

    public function index()
    {
        try{
            $data = Matieres::where('deleted_at', null)->orderBy('matiere_id', 'desc')->get();
            return Response()->json(["message" =>"ok", "issues" => '', "success" => true, "data" => $data], 200);
        } catch (Exception $e) {
            return Response()->json(["message" =>"exception", "issues" => $e->getMessage(), "success" => false, "data" => null], 500);
        }

    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            'code_mat' => 'required|string|max:20',
            'intitule_mat' => 'required|string|max:255',
            'filiere_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }
        $check = Matieres::where('code_mat',$request->code_mat)->get();
        if (count($check)) {
            return Response()->json(["message" =>"duplication", "issues" => 'Une matiere avec ce code existe deja', "success" => false, "data" => $request->code_mat], 500);
        }
        $data = Matieres::create([
            'code_mat' => $request->code_mat,
            'intitule_mat' => $request->intitule_mat,
            'filiere_id' => $request->filiere_id,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'MAtiere created successfully',
            'matiere' => $data,
        ]);
    }

    public function show($id)
    {
        $matiere = Matieres::find($id);
        return response()->json([
            'status' => 'success',
            'matiere' => $matiere,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all() ,[
            'code_mat' => 'required|string|max:20',
            'intitule_mat' => 'required|string|max:255',
            'filiere_id' => 'required',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }

        $check = Matieres::where('code_mat',$request->code_fil)->where('filiere_id','!=', $id)->get();
        if (count($check)) {
            return response()->json([
                'status' => 'Failled',
                'message' => 'Une filiere existe deja avec ce code',
                'data' => $request->intitule_fil,
            ]);
        }

        $matiere = Matieres::find($id);
        $matiere->code_mat = $request->code_mat;
        $matiere->intitule_mat = $request->filiere_id;
        $matiere->filiere_id = $request->filiere_id;
        $matiere->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La matiere a ete modifie.',
            'matiere' => $matiere,
        ]);
    }

    public function destroy($id)
    {
        $matiere = Matieres::find($id);
        if ($matiere == null) {
            return response()->json([
                'status' => 'Failled',
                'message' => "Cette matiere n'existe pas",
                'data' => $id,
            ]);
        }
        $matiere->deleted_at = date('Y-m-d H:i:s');
        $matiere->save();

        return response()->json([
            'status' => 'success',
            'message' => 'supprimee avec success',
            'matiere' => $matiere,
        ]);
    }
}
