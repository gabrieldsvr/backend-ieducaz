<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class FunnelCard extends Model
{

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';


    public function save(array $options = [])
    {
        if (!isset($this->id ) || $this->id == null){
            $this->id = (string)Str::uuid();
        }

        $funnelDAO = new Funnel();
        $funnel = $funnelDAO->getFunnel();

        $this->funnel = $funnel->id;

        return parent::save($options);
    }

    public function getAllCards(Funnel $funnel)
    {
        $cards = FunnelCard::where('funnel', $funnel->id)->get();
        return $cards;
    }

    public static function getById($id){
        $result = FunnelCard::where('id',"=", $id);
        return $result;
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person', 'id')->first();
    }
    public function imovel()
    {
        return $this->belongsTo(Imovel::class, 'imovel', 'uuid')->first();
    }


}
