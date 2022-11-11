<?php

namespace App\Http\Controllers;

use App\Models\Imovel;
use App\Models\Item;
use App\Models\ItemDetail;
use Illuminate\Http\Request;
use App\Models\File;
use Illuminate\Support\Facades\Storage;

class FileUploadController extends Controller
{
    public function createForm(){
//        return view('file-upload');
    }
    public function fileUpload(Request $request){

        $callback = [];

        if($request->hasFile('photos'))
        {
            $files = $request->file('photos');
            $data = $request->except(['photos']);
            foreach($files as $file) {
                $filename = $file->getClientOriginalName();
                $full_name = str_replace(' ', '', time() . "-" . $filename);
                $bucket = "https://s3.sa-east-1.amazonaws.com/storage-adminsystem.com.br/imoveis/";
                $url = $bucket . $full_name;

                $images_url[] = str_replace(' ', '', $url);

                Storage::disk('s3')->putFileAs('imoveis/', $file, $full_name);


            }
            $imovelDAO = new Imovel();
            $imovel = $imovelDAO->getByUuid($data['id'])[0];
            $json = $imovel->json;
            $json['imagens'] = array_merge($json['imagens'],$images_url);
            $imovel->json = $json;
            $imovel->save();
            $callback["url"] = route("imovel.index");
            $callback["message"] = "Sucesso!";
            echo json_encode($callback);
        }
    }
}
