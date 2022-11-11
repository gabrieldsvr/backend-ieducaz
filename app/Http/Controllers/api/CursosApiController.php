<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\CursosResource;
use App\Models\Alunos;
use App\Models\Cursos;
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
}
