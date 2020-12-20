<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Equipo;

class EquipoController extends Controller
{
    //
	public function createEquipo(Request $request)
	{
		
		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el equipo
		if($data){
			$equipo = new Equipo();

			//TODO: Validar los datos antes de guardar el equipo

			$equipo->id = $data->id;
			$equipo->nombre = $data->nombre;
			
			try{
				$equipo->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

			
		}

		
		return response($response);
	}

	public function updateEquipo(Request $request, $id){

		$response = "";

		//Buscar el equipo por su id

		$equipo = Equipo::find($id);

		if($equipo){

			//Leer el contenido de la petición
			$data = $request->getContent();

			//Decodificar el json
			$data = json_decode($data);

			//Si hay un json válido, buscar el equipo
			if($data){
			
				//TODO: Validar los datos antes de guardar el equipo
				$equipo->nombre = (isset($data->nombre) ? $data->nombre : $equipo->nombre);

				try{
					$equipo->save();
					$response = "OK";
				}catch(\Exception $e){
					$response = $e->getMessage();
				}
			}

			
		}else{
			$response = "No equipo";
		}

		
		return response($response);
	}

	public function deleteEquipo(Request $request, $id){

		$response = "";
		
		//Buscar el equipo por su id

		$equipo = Equipo::find($id);

		if($equipo){

			try{
				$equipo->delete();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}
						
		}else{
			$response = "No equipo";
		}

		
		return response($response);
	}
/*
	public function addCategory(Request $request){

		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el equipo
		if($data&&equipo::find($data->equipo)&&Category::find($data->category)){
			$equipoCategory = new Categoriesequipo();

			//TODO: Validar los datos antes de guardar el equipo

			$equipoCategory->equipos_id = $data->equipo;
			$equipoCategory->categories_id = $data->category;
			try{
				$equipoCategory->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

		}
		return response($response);

	}
*/
	public function viewEquipo($id){

		$response = "";
		$equipo = Equipo::find($id);

		if($equipo){

			$response = [
				"nombre" => $equipo->nombre,
				"ID" => $equipo->id
				//"equipo" => $equipo->equipo
			];

		}else{
			$response = "equipo no encontrado";
		}

		return response()->json($response);
	}

	public function listEquipos(){

		$response = "";
		$equipos = Equipo::all();

		$response= [];

		foreach ($equipos as $equipo) {
			$response[] = [
				"nombre" => $equipo->nombre,
				"ID" => $equipo->id
				//"equipo" => $equipo->equipo
			];
		}
		


		return response()->json($response);
	}
/*
	public function viewCopies($id){

		$equipo = equipo::find($id);

		$response = "";

		if($equipo){
			$response = $equipo->copies;
		}

		return response()->json($response);
	}*/
}