<?php

namespace App\Http\Controllers;

use App\Models\Salles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class SallesController extends Controller
{
    //

    public function index()
    {
        $data = Salles::where('deleted_at', null)->orderBy('salle_id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all() ,[
            'numero' => 'required|string|max:20',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }
        $check = Salles::where('numero',$request->numero)->get();
        if (count($check)) {
            return response()->json([
                'status' => 'Failled',
                'message' => 'Une salle existe deja avec ce numero',
                'data' => $request->numero,
            ]);
        }
        $data = Salles::create([
            'numero' => $request->numero,
            'description' => $request->description,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Enseignant created successfully',
            'enseignant' => $data,
        ]);
    }

    public function show($id)
    {
        $salle = Salles::find($id);
        return response()->json([
            'status' => 'success',
            'salle' => $salle,
        ]);
    }

    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all() ,[
            'numero' => 'required|string|max:20',
            'description' => 'required|string|max:255',
        ]);
        if ($validator->fails()) {
            return Response()->json(["message" =>"validation", "issues" =>$validator->errors(), "success" => false, "data" => null], 500);
        }

        $check = Salles::where('numero',$request->numero)->where('salle_id','!=', $id)->get();
        if (count($check)) {
            return response()->json([
                'status' => 'Failled',
                'message' => 'Une salle existe deja avec ce numero',
                'data' => $request->numero,
            ]);
        }

        $salle = Salles::find($id);
        $salle->numero = $request->numero;
        $salle->description = $request->description;
        $salle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La salle a bien ete modifie',
            'salle' => $salle,
        ]);
    }

    public function destroy($id)
    {
        $salle = Salles::find($id);
        $salle->deleted_at = date('Y-m-d H:i:s');
        $salle->save();

        return response()->json([
            'status' => 'success',
            'message' => 'salle supprime avec success',
            'salle' => $salle,
        ]);
    }
}
