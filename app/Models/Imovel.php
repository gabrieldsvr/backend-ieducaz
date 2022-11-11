<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Imovel extends Model
{
    use HasFactory;

    protected $table = 'imovel';
    protected $casts = [
        'json' => 'array',
    ];

    public function setJsonAttribute($value)
    {
        $this->attributes['json'] = json_encode($value);
    }

    /**
     * Retorna Imoveis do usuario
     *
     * @return Imovel
     */
    public function getAllImovel(){
        $usuario = auth()->user();
        $company = $usuario->company();
        $website = $company->website();
        return Imovel::where('website_id', $website->uuid)->get();
    }


    public function getByUuid($uuid){
        return Imovel::where('uuid', $uuid)->get();
    }


    public function getName(){
        return $this->json['nome'];
    }

    public function save(array $options = [])
    {
        $caracteristicas = ['caracteristicas' => [
            "cama" => $this->json['dormitorios'],
            "suites" => $this->json['suites'] ?? 0,
            "banheiro" => $this->json['banheiros'],
            "area" => $this->json['area'],
            "garagem" => $this->json['garagem'],
        ]];






        $this->json = array_merge($caracteristicas,$this->json);
        return parent::save($options);
    }

    public function websites(){
        return $this->belongsTo(Website::class,'website_id','uuid');
    }

}
