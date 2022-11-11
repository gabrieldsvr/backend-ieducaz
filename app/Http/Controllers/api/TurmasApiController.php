<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\TurmasResource;
use App\Models\Turmas;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TurmasApiController extends Controller
{
    public function index()
    {
        $turmas = Turmas::all();
        return TurmasResource::collection($turmas);
    }

    public function store(Request $request)
    {

        try {
            $data = $request->except(['_token']);
            $turma = new Turmas();
            $turma->id = (string)Str::uuid();
            $turma->nome = $data['nome'];
            $turma->curso = $data['curso'];
            $turma->nivel = $data['nivel'];

            if (isset($data['maximo_alunos']) && $data['maximo_alunos'] == true) {
                $turma->maximo_alunos = $data['maximo_alunos'];
                $turma->numero_maximo_alunos = $data['numero_maximo_alunos'];
            } else {
                $turma->maximo_alunos = false;
                $turma->numero_maximo_alunos = 999;
            }
            $turma->save();
            return response()->json([
                "message" => "Turma criada com sucesso",
                "status"
            ], 201);
        } catch (Exception $exception) {
            return response()->json([
                "message" => $exception
            ], 404);
        }
    }
}
