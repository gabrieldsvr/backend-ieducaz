<?php

namespace App\Http\Controllers;

use App\Class\StringUtils;
use App\Models\Imovel;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImovelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index()
    {
        $usuario = auth()->user();
        $company = $usuario->company();
        $website = $company->website();

        $imoveis = Imovel::where('website_id', $website->uuid)->get();
        return view('imovel.index', [
            "listImovel" => $imoveis
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create()
    {
        return view('imovel.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        $callback = [];
        try {

            $imagem_destaque = $request->file('imagem_destaque');
            $files = $request->file('photos');

            $images_url = [];
            if (isset($files)) {
                foreach ($files as $file) {
                    $filename = $file->getClientOriginalName();
                    $full_name = str_replace(' ', '', time() . "-" . $filename);
                    $bucket = "https://s3.sa-east-1.amazonaws.com/storage-adminsystem.com.br/imoveis/";
                    $url = $bucket . $full_name;

                    $images_url[] = str_replace(' ', '', $url);

                    Storage::disk('s3')->putFileAs('imoveis/', $file, $full_name);
                }
            }

            if (isset($imagem_destaque)) {
                foreach ($imagem_destaque as $file) {
                    $filename = $file->getClientOriginalName();
                    $full_name = str_replace(' ', '', time() . "-" . $filename);
                    $bucket = "https://s3.sa-east-1.amazonaws.com/storage-adminsystem.com.br/imoveis/";
                    $url = $bucket . $full_name;

                    $imagem_destaque_url = str_replace(' ', '', $url);

                    Storage::disk('s3')->putFileAs('imoveis/', $file, $full_name);
                }
            }

            $imovel = new Imovel();
            $imovel->json = array_merge($request->except(['_token', 'photos']), ["imagens" => $images_url, "imagem_destaque" => $imagem_destaque_url]);
            $imovel->uuid = (string)Str::uuid();
            $imovel->status = true;
            $imovel->slug = Str::of($imovel->json['nome'])->slug('-');

            $usuario = auth()->user();
            $company = $usuario->company();
            $website = $company->website();

            $imovel->website_id = $website->uuid;

            $id = $imovel->save();
            $callback["message"] = "Sucesso!";
            $callback["data"] = $imovel->uuid;
            echo json_encode($callback);

        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }

    /**
     * Display the specified resource.
     *
     * @param Imovel $imovel
     * @return Response
     */
    public function show(Imovel $imovel)
    {
        dd($imovel);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Imovel $imovel
     * @return Application|Factory|View
     */
    public function edit(Imovel $imovel)
    {

        return view('imovel.edit', ["imovel" => $imovel->json, "id" => $imovel->id]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param Imovel $imovel
     * @return Response
     */
    public function update(Request $request, Imovel $imovel)
    {
        try {


            $jsonRequest = $request->except(['_token', '_method', 'photos', 'imagem_destaque']);

            $imagem_destaque = $request->file('imagem_destaque');
            $files = $request->file('photos');

            $antigasImagens = $imovel->json['imagens'];
            $antigaImagemDestaque = $imovel->json['imagem_destaque'];

            $imovel->json = $jsonRequest;
            $imovel->slug = Str::of($imovel->json['nome'])->slug('-');

            if (!is_null($files)) {
                $imovel->json = array_merge($imovel->json, ["imagens" => []]);
            } else {
                $imovel->json = array_merge($imovel->json, ["imagens" => $antigasImagens]);
            }

            if (!is_null($imagem_destaque)) {
                $url_nova_imagem_destaque = AwsController::fileUpload($imagem_destaque, "imoveis", false);

                $path = explode("imoveis/", $antigaImagemDestaque)[1];
                AwsController::fileDelete($path);

                $imovel->json = array_merge($imovel->json, ["imagem_destaque" => $url_nova_imagem_destaque]);
            } else {
                $imovel->json = array_merge($imovel->json, ["imagem_destaque" => $antigaImagemDestaque]);
            }


            $id = $imovel->save();
            $callback["message"] = "Sucesso!";
            $callback["url"] = route("imovel.index");
            $callback["data"] = $imovel->uuid;


            echo json_encode($callback);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Imovel $imovel
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy(Imovel $imovel)
    {
        $imovel->deleteOrFail();
        return redirect('/imovel')->with('msg', 'excluido');
    }

    /**
     * Chage status imovel in DB
     *
     * @param Imovel $imovel
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function changeStatus(Imovel $imovel)
    {
        if ($imovel->status) {
            $imovel->status = false;
        } else {
            $imovel->status = true;
        }
        $imovel->save();
        return redirect('/imovel')->with('msg', 'Inativado');
    }

    /**
     * Duplicate imovel
     *
     * @param Imovel $imovel
     * @return Application|\Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function duplicate(Imovel $imovel)
    {
        $jsonDuplicate = $imovel->json;
        $jsonDuplicate['nome'] = $imovel->json['nome']."(2)";

        $imovelNovo = new Imovel();
        $imovelNovo->json = $jsonDuplicate;
        $imovelNovo->uuid = (string)Str::uuid();
        $imovelNovo->status = true;
        $imovelNovo->slug = Str::of($imovelNovo->json['nome'])->slug('-');

        $usuario = auth()->user();
        $company = $usuario->company();
        $website = $company->website();

        $imovelNovo->website_id = $website->uuid;

        $imovelNovo->save();
        $callback["message"] = "Sucesso!";
        return redirect()->route("imovel.edit",$imovelNovo);
    }

    /**
     * Search CEP
     *
     * @param string $cep
     * @return void
     */
    public function cep(string $cep)
    {
        $cep_format = StringUtils::RemoveSpecialChar($cep);
        $response = Http::get("https://viacep.com.br/ws/{$cep_format}/json");

        if ($response->ok()) {
            if (isset(json_decode($response->body())->erro)) {
                echo "Não foi encontrado o CEP";
            } else {
                echo $response->body();
            }
        } else {
            echo "Erro de busca";
        }
    }
}
