<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Funnel extends Model
{

    protected $table = 'funnels';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $casts = [
        'json' => 'array',
    ];



    public function setJsonAttribute($value)
    {
        $this->attributes['json'] = json_encode($value);
    }


    public function createFirstFunnel(){
        $usuario = auth()->user();
        $funnel = new Funnel();
        $funnel->id = (string)Str::uuid();
        $funnel->user_id = $usuario->id;
        $funnel->status = true;
        $funnel->json = array(
            [
            "order"=> 0,
            "color"=> "#fd9526",
            "name"=> "Oportunidades",
        ],
            [
                "order"=> 1,
                "color"=> "#595bd3",
                "name"=> "Atendimento",
            ],
            [
                "order"=> 2,
                "color"=> "#d031c0",
                "name"=> "Visita agendada",
            ],
            [
                "order"=> 3,
                "color"=> "#0084f4",
                "name"=> "Visita realizada",
            ],
            [
                "order"=> 4,
                "color"=> "brown",
                "name"=> "Proposta",
            ],
            [
                "order"=> 5,
                "color"=> "#f84343",
                "name"=> "Falta assinar",
            ]);

        $funnel->save();
    }

    public function getFunnel(){
        $usuario = auth()->user();

        $funnel = Funnel::where('user_id', $usuario->id)->get();

        if ($funnel->count() == 0 ){
            $this->createFirstFunnel();
            $this->getFunnel();
        }else{
            return $funnel[0];
        }
    }




}
