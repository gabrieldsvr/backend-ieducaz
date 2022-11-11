<?php

namespace App\Http\Controllers;

use App\Models\Funnel;
use App\Models\FunnelCard;
use App\Models\Imovel;
use App\Models\Person;
use Illuminate\Http\Request;

class FunnelCardsController extends Controller
{
    public function index($id)
    {


    }

    public function getCard(Request $request)
    {
        $data = $request->except(['_token']);
        $card = $data['card'];
//        $card = FunnelCard::find($dtCard['id']);
        return view('crm.funnel.card', [
            "card" => $card
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


        return view('crm.funnel.create', [
            "funnel" => $funnel,
            "people" => $people,
            "imoveis" => $imoveis,
        ]);
    }

    public function store(Request $request)
    {
        try {
            $data = $request->except(['_token']);

            $FunnelCard = new FunnelCard();

            $FunnelCard->order = $data['order'];
            $FunnelCard->person = $data['person'];
            $FunnelCard->imovel = $data['imovel'];

            $FunnelCard->save();
            $FunnelCard->person = $FunnelCard->person()->name;
            $FunnelCard->imovel = $FunnelCard->imovel()->getName();

            $callback["message"] = "Sucesso!";
            $callback["order"] = $data['order'];
            $callback["card"] = $FunnelCard;
            echo json_encode($callback);

        } catch (\Exception $exception) {
            echo $exception;
        }

    }

    public function show(FunnelCard $funnelCard)
    {
    }

    public function edit(FunnelCard $funnelCard)
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


        return view('crm.funnel.edit', [
            "funnel" => $funnel,
            "card" => $funnelCard,
            "people" => $people,
            "imoveis" => $imoveis,
        ]);


    }

    public function update(Request $request, FunnelCard $funnelCard)
    {
        try {
            $data = $request->except(['_token']);
            $funnelCard->person = $data['person'];
            $funnelCard->imovel = $data['imovel'];
            $funnelCard->save();
            $funnelCard->person = $funnelCard->person()->name;
            $funnelCard->imovel = $funnelCard->imovel()->getName();

            $callback["message"] = "Sucesso!";
            $callback["order"] = $data['order'];
            $callback["card"] = $funnelCard;
            echo json_encode($callback);

        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function destroy($id)
    {
        try {
            $people = FunnelCard::find($id);
            $retorno = $people->deleteOrFail();
            $callback["message"] = "Sucesso!";
            echo json_encode($callback);
        } catch (\Exception $exception) {
            echo $exception;
        }
    }

    public function changePosition(Request $request)
    {
        try {
            $data = $request->except(['_token']);
            $card = FunnelCard::find($data['id']);
            $card->order = $data['order'];
            $card->id = $data['id'];
            $card->save();


        } catch (\Exception $exception) {
            echo $exception;
        }
    }
}
