<?php

namespace App\Http\Controllers;

use App\Models\Levels;
use App\Models\View_level_dev as ViewLevel;

use Illuminate\Http\Request;

class ApiLevelController extends Controller
{
    public function getAllLevels() {
        $levels = ViewLevel::get()->toJson(JSON_PRETTY_PRINT);
        return response($levels, 200);        
    }
  
    public function createLevel(Request $request) {
        try{
            $level = new Levels;
            $level->nivel = $request->nivel;
            $level->save();

            return response()->json([
                "success" => "Nível criado com sucesso"
            ], 201);   
        } catch(\Exception $e){
            return response()->json([
                'errors'=>'Ocorreu um erro ao tentar criar o Nível. Tente novamente.'
            ],400);
        }     
    }
  
    public function getLevel($id) {
        if (Levels::where('id', $id)->exists()) {
            $level = Levels::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($level, 200);
        } else {
            return response()->json([
              "errors" => "Nível não encontrato"
            ], 404);
        }
    }
  
    public function updateLevel(Request $request) {
        $id_level = $request->hidden_id;
        if (Levels::where('id', $id_level)->exists()) {
            $level = Levels::find($id_level);
            $level->nivel = is_null($request->nivel) ? $level->nivel : $request->nivel;
            $level->update();
    
            return response()->json([
                "success" => "Nível atualizado com sucesso!"
            ], 200);
        } else {
            return response()->json([
                "errors" => "Nível não encontrado!"
            ], 400);
            
        }
    }
  
    public function deleteLevel ($id) {        
        if(Levels::where('id', $id)->exists()) {
            $level = Levels::find($id);
            $level->delete();
    
            return response()->json([
                "success" => "Nível excluído com sucesso!"
            ], 200);
        } else {
            return response()->json([
                "errors" => "Não foi possível excluir o nível!"
            ], 400);
            
        }
    }
}
