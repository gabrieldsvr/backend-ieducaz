<?php

namespace App\Http\Controllers;

use App\Models\PageType;
use App\Models\User;

class WebController extends Controller
{
    public function dashboard()
    {
        $imovel = [];

        $usuario = auth()->user();
        $company = $usuario->company();
        $webiste = $company->website();
        $imovel = $webiste->imoveis()->get();
        return view('home.index',
        ['usuario' => $usuario,
        'company' => $company,
        'website' => $webiste,
        'imovel' => $imovel,
        ]);
    }
    public function website(string $id)
    {
        $PageTypeController = new PageTypesController();
        $PageType = $PageTypeController->show($id);


        return view('website.index',[
            "pageTypeId" => $PageType->id,
            "pageTypeName" => $PageType->name,
            "pageTypeConfig" => $PageType->config
        ]);
    }


}
