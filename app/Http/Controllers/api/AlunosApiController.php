<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlunosResource;
use App\Models\Alunos;
use App\Models\Imovel;

class AlunosApiController extends Controller
{
    public function index()
    {
        $alunos = Alunos::getAll();
        return AlunosResource::collection($alunos);
    }
}
