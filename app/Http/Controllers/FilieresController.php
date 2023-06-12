<?php

namespace App\Http\Controllers;

use App\Models\Filieres;
use Illuminate\Http\Request;

class FilieresController extends Controller
{
    //

    public function index()
    {
        $data = Filieres::where('deleted_at', null)->orderBy('filiere_id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'code_fil' => 'required|string|max:20',
            'intitule_fil' => 'required|string|max:255',
        ]);
        $check = Filieres::where('code_fil',$request->code_fil)->get();
        if (count($check)) {
            return response()->json([
                'status' => 'Failled',
                'message' => 'Une filiere avec ce code existe deja',
                'data' => $request->code_fil,
            ]);
        }
        $data = Filieres::create([
            'code_fil' => $request->code_fil,
            'intitule_fil' => $request->intitule_fil,
        ]);

        return response()->json([
            'status' => 'success',
            'message' => 'Filiere created successfully',
            'filiere' => $data,
        ]);
    }

    public function show($id)
    {
        $filiere = Filieres::find($id);
        return response()->json([
            'status' => 'success',
            'filiere' => $filiere,
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'code_fil' => 'required|int|max:20',
            'intitule_fil' => 'required|string|max:255',
        ]);

        $check = Filieres::where('code_fil',$request->code_fil)->where('filiere_id','!=', $id)->get();
        if (count($check)) {
            return response()->json([
                'status' => 'Failled',
                'message' => 'Une filiere existe deja avec ce code',
                'data' => $request->intitule_fil,
            ]);
        }

        $filiere = Filieres::find($id);
        $filiere->code_fil = $request->code_fil;
        $filiere->intitule_fil = $request->intitule_fil;
        $filiere->save();

        return response()->json([
            'status' => 'success',
            'message' => 'La filiere a ete modifie.',
            'filiere' => $filiere,
        ]);
    }

    public function destroy($id)
    {
        $filiere = Filieres::find($id);
        $filiere->deleted_at = date('Y-m-d H:i:s');
        $filiere->save();

        return response()->json([
            'status' => 'success',
            'message' => 'supprimee avec success',
            'filiere' => $filiere,
        ]);
    }
}
