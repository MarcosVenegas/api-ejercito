<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Soldado;
use App\Models\EquiposSoldado;
use App\Models\Equipo;

class SoldadoController extends Controller
{
    //
	public function createSoldado(Request $request)
	{
		
		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el soldado
		if($data){
			$soldado = new Soldado();

			//TODO: Validar los datos antes de guardar el soldado

			$soldado->numeroPlaca = $data->numeroPlaca;
			$soldado->nombre = $data->nombre;
			$soldado->apellidos = $data->apellidos;
			$soldado->fechaNacimiento = $data->fechaNacimiento;
			$soldado->rango = $data->rango;
			$soldado->estado = $data->estado;
			try{
				$soldado->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

			
		}

		
		return response($response);
	}

	public function updateSoldado(Request $request, $numeroPlaca){

		$response = "";

		//Buscar el soldado por su id

		$soldado = Soldado::find($numeroPlaca);

		if($soldado){

			//Leer el contenido de la petición
			$data = $request->getContent();

			//Decodificar el json
			$data = json_decode($data);

			//Si hay un json válido, buscar el soldado
			if($data){
			
				//TODO: Validar los datos antes de guardar el soldado
				$soldado->estado = (isset($data->estado) ? $data->estado : $soldado->estado);

				try{
					$soldado->save();
					$response = "OK";
				}catch(\Exception $e){
					$response = $e->getMessage();
				}
			}

			
		}else{
			$response = "No soldado";
		}

		
		return response($response);
	}

	public function deleteSoldado(Request $request, $numeroPlaca){

		$response = "No se puede borrar un soldado (Si entras ya no sales). Edita su estado con /edit/numeroPlaca y dale de baja";

		return response($response);
	}

	public function addEquipo(Request $request){

		$response = "";
		//Leer el contenido de la petición
		$data = $request->getContent();

		//Decodificar el json
		$data = json_decode($data);

		//Si hay un json válido, crear el soldado
		if($data&&Soldado::find($data->soldado)&&Equipo::find($data->equipo)){
			$soldadoEquipo = new EquiposSoldado();

			//TODO: Validar los datos antes de guardar el soldado

			$soldadoEquipo->numeroPlaca = $data->soldado;
			$soldadoEquipo->equipo_id = $data->equipo;
			try{
				$soldadoEquipo->save();
				$response = "OK";
			}catch(\Exception $e){
				$response = $e->getMessage();
			}

		}
		return response($response);

	}

	public function viewSoldado($numeroPlaca){

		$response = "";
		$soldado = Soldado::find($numeroPlaca);

		if($soldado){

			$response = [
				"nombre" => $soldado->nombre,
				"apellidos" => $soldado->apellidos,
				"rango" => $soldado->rango,
				"fecha de nacimiento" => $soldado->fechaNacimiento,
				"fecha de incorporación" => $soldado->created_at,
				"numero de placa" => $soldado->numeroPlaca,
				"estado" => $soldado->estado
				//"equipo" => $soldado->equipo
			];

		}else{
			$response = "Soldado no encontrado";
		}

		return response()->json($response);
	}

	public function listSoldados(){

		$response = "";
		$soldados = Soldado::all();

		$response= [];

		foreach ($soldados as $soldado) {
			$response[] = [
				"nombre" => $soldado->nombre,
				"apellidos" => $soldado->apellidos,
				"rango" => $soldado->rango,
				"numero de placa" => $soldado->numeroPlaca,
				"estado" => $soldado->estado,
				"equipo ID" => $soldado->equipo_id,
				"nombre equipo" => $soldado->nombreEquipo
			];
		}
		


		return response()->json($response);
	}
/*
	public function viewCopies($id){

		$soldado = Soldado::find($id);

		$response = "";

		if($soldado){
			$response = $soldado->copies;
		}

		return response()->json($response);
	}*/
}