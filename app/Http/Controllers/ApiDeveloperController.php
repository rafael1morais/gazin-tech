<?php

namespace App\Http\Controllers;

use App\Models\Developers;
use App\Models\View_developers as ViewDev;

use Illuminate\Http\Request;

class ApiDeveloperController extends Controller
{
    public function getAllDevelopers() {
        $dev = ViewDev::get()->toJson(JSON_PRETTY_PRINT);
        return response($dev, 200);  
    }
  
    public function createDeveloper(Request $request) {
        try{
            $idade = $this->calcula_idade($request->datanascimento);
            $request->idade = $idade;

            $developer = new Developers;
            $developer->nome = $request->nome;
            $developer->nivel = $request->nivel;
            $developer->sexo = $request->sexo;
            $developer->datanascimento = $request->datanascimento;
            $developer->idade = $request->idade;
            $developer->hobby = $request->hobby;
            $developer->save();

            return response()->json([
                "success" => "Desenvolvedor criado com sucesso"
            ], 201);   
        } catch(\Exception $e){
            return response()->json([
                'errors'=>'Ocorreu um erro ao tentar criar o Desenvolvedor. Tente novamente.'
            ],400);
        }   
    }
  
    public function getDeveloper($id) {
        if (ViewDev::where('id', $id)->exists()) {
            $dev = ViewDev::where('id', $id)->get()->toJson(JSON_PRETTY_PRINT);
            return response($dev, 200);
        } else {
            return response()->json([
              "errors" => "Desenvolvedor não encontrato"
            ], 404);
        }
    }
  
    public function updateDeveloper(Request $request) {
        $id_dev = $request->hidden_id;
        if (Developers::where('id', $id_dev)->exists()) {
            $idade = $this->calcula_idade($request->datanascimento);
            $request->idade = $idade;
            $developer = Developers::find($id_dev);
            $developer->nome = $request->nome;
            $developer->nivel = $request->nivel;
            $developer->sexo = $request->sexo;
            $developer->datanascimento = $request->datanascimento;
            $developer->idade = $request->idade;
            $developer->hobby = $request->hobby;
            $developer->update();
    
            return response()->json([
                "success" => "Desenvolvedor atualizado com sucesso!"
            ], 200);
        } else {
            return response()->json([
                "errors" => "Desenvolvedor não encontrado!"
            ], 400);
            
        }
    }
  
    public function deleteDeveloper ($id) {
        if(Developers::where('id', $id)->exists()) {
            $developer = Developers::find($id);
            $developer->delete();
    
            return response()->json([
                "success" => "Desenvolvedor excluído com sucesso!"
            ], 200);
        } else {
            return response()->json([
                "errors" => "Não foi possível excluir o desenvolvedor!"
            ], 400);
            
        }
    }

    public static function calcula_idade($nascimento) {
        $dataNascimento = $nascimento;
        $date = new \DateTime($dataNascimento );
        $interval = $date->diff( new \DateTime( date('Y-m-d') ) );
        return $interval->format( '%Y' );
    }
}
