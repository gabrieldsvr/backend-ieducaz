<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AlunosResource;
use App\Models\Alunos;

class AlunosApiController extends Controller
{
    public function index()
    {
        $alunos = Alunos::all();
        return AlunosResource::collection($alunos);
    }

}
