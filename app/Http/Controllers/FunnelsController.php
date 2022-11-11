<?php

namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\FunnelCard;
use App\Models\Imovel;
use App\Models\Person;
use Illuminate\Http\Request;

class FunnelsController extends Controller
{
    public function index()
    {

        $funnelDAO = new Funnel();
        $funnelCardDAO = new FunnelCard();
        $funnel = null;
        while ($funnel == null) {
            $funnel = $funnelDAO->getFunnel();
        }

        $cards = $funnelCardDAO->getAllCards($funnel);

        return view('crm.funnel.index', [
            "funnel" => $funnel,
            "cards" => $cards,

        ]);
    }


    public function create()
    {

        $funnelDAO = new Funnel();
        $funnel = null;
        while ($funnel == null) {
            $funnel = $funnelDAO->getFunnel();
        }

        $Person = new Person();
        $Imovel = new Imovel();

        $people = $Person->getAllPeople();
        $imoveis = $Imovel->getAllImovel();



        return view('crm.funnel.create',[
            "funnel" => $funnel,
            "people" => $people,
            "imoveis" => $imoveis,
        ]);
    }

    public function store(Request $request)
    {
    }

    public function show(Funnel $funnel)
    {
    }

    public function edit(Funnel $funnel)
    {
    }

    public function update(Request $request, Funnel $funnel)
    {
    }

    public function destroy(Funnel $funnel)
    {
    }
}
