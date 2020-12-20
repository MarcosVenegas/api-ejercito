<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Mision;

class MisionController extends Controller
{
    //
	public function createMision(Request $request)
	{
		
		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el libro
		if($data){
			$mision = new Mision();

			//TODO: Validar los datos antes de guardar el libro

			$mision->id = $data->id;
			$mision->descripcion = $data->descripcion;
			$mision->prioridad = $data->prioridad;
			$mision->estado = $data->estado;
			try{
				$mision->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

			
		}

		
		return response($response);
	}

	public function updateMision(Request $request, $id){

		$response = "";

		//Buscar el libro por su id

		$mision = Mision::find($id);

		if($mision){

			//Leer el contenido de la petición
			$data = $request->getContent();

			//Decodificar el json
			$data = json_decode($data);

			//Si hay un json válido, buscar el libro
			if($data){
			
				//TODO: Validar los datos antes de guardar el libro
				$mision->descripcion = (isset($data->descripcion) ? $data->descripcion : $mision->descripcion);
				$mision->prioridad = (isset($data->prioridad) ? $data->prioridad : $mision->prioridad);
				$mision->estado = (isset($data->estado) ? $data->estado : $mision->estado);

				try{
					$mision->save();
					$response = "OK";
				}catch(\Exception $e){
					$response = $e->getMessage();
				}
			}

			
		}else{
			$response = "No mision";
		}

		
		return response($response);
	}

	public function deleteMision(Request $request, $id){

		$response = "";
		
		//Buscar el libro por su id

		$mision = Mision::find($id);

		if($mision){

			try{
				$mision->delete();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}
						
		}else{
			$response = "No mision";
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

		//Si hay un json válido, crear el libro
		if($data&&mision::find($data->mision)&&Category::find($data->category)){
			$misionCategory = new Categoriesmision();

			//TODO: Validar los datos antes de guardar el libro

			$misionCategory->misiones_id = $data->mision;
			$misionCategory->categories_id = $data->category;
			try{
				$misionCategory->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

		}
		return response($response);

	}
*/
	public function viewMision($id){

		$response = "";
		$mision = Mision::find($id);

		if($mision){

			$response = [
				"id" => $mision->id,
				"descripcion" => $mision->descripcion,
				"prioridad" => $mision->prioridad,
				"estado" => $mision->estado,
				"fecha de registro" => $mision->created_at
			];

		}else{
			$response = "mision no encontrado";
		}

		return response()->json($response);
	}

	public function listMisiones(){

		$response = "";
		$mision = Mision::orderBy('prioridad')->get();

		$response= [];

		foreach ($misiones as $mision) {
			$response[] = [
				"id" => $mision->id,
				"fecha de registro" => $mision->created_at,
				"prioridad" => $mision->prioridad,
				"estado" => $mision->estado
				//"equipo" => $mision->equipo
			];
		}
		


		return response()->json($response);
	}
/*
	public function viewCopies($id){

		$mision = mision::find($id);

		$response = "";

		if($mision){
			$response = $mision->copies;
		}

		return response()->json($response);
	}*/
}