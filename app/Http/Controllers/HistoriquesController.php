<?php

namespace App\Http\Controllers;

use App\Models\Historiques;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HistoriquesController extends Controller
{
    //


    public function list(){
       $data = Historiques::where('deleted_at',null)->orderBy('id', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'data' => $data,
        ]);
    }

    public function save($action, $model,$description,$id){
        $save = Historiques::create([
            'action' => $action,
            'model' => $model,
            'description' => $description,
            'model_id' => $id,
            'user_id' => Auth::user()->id,
        ]);
        return $save;
    }

    public function delete($id){
        $save = Historiques::find($id);

        $save->deleted_at = date('Y-m-d H:i:s');
        $save->save();

        return response()->json([
            'status' => 'success',
            'message' => 'supprimee avec success',
            'save' => $save,
        ]);
    }
}
