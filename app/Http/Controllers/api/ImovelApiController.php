<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Http\Resources\ImovelResource;
use App\Models\Imovel;
use Illuminate\Support\Facades\DB;

class ImovelApiController extends Controller
{
    public function index($uuid)
    {
        $imoveis = Imovel::where([
            ['website_id', $uuid],
            ['status', 1],
        ])->get();
        return ImovelResource::collection($imoveis);
    }
}
