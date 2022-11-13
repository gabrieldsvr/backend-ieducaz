<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CursosResource;
use App\Models\Alunos;
use App\Models\Cursos;
use App\Models\Funnel;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CursosApiController extends Controller
{
    public function index()
    {
        $cursos = Cursos::all();
        return CursosResource::collection($cursos);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(['_token']);
            $curso = new Cursos();
            $curso->id = (string)Str::uuid();
            $curso->nome = $data['nome'];
            $curso->nivel = $data['nivel'];
            $curso->save();
            return response()->json([
                "message" => "Curso criado com sucesso",
                "status"
            ], 201);
        } catch (\Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 404);
        }
    }


    public function show(Cursos $curso)
    {
        try {

            return response()->json([
                "data" => $curso,
            ], 200);
        } catch (\Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 404);
        }
    }

    public function edit(Cursos $curso)
    {

    }

    public function update(Request $request, Cursos $curso)
    {
        $data = $request->except(['_token']);
        try {

            $curso->nome = $data['nome'];
            $curso->nivel = $data['nivel'];
            $curso->save();
            return response()->json([
                "message" => "Curso editado com sucesso",
                "status"
            ]);
        } catch (\Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 404);
        }

    }

    public function destroy(Cursos $curso)
    {

        try {
            $curso->delete();
            return response()->json([
                "message" => "Curso deletado com sucesso!"
            ],202);
        } catch (\Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 406);
        }
    }

}
