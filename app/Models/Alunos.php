<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Alunos extends Model
{
    use HasFactory;

    protected $table = 'alunos';
    protected $casts = [
        'json' => 'array',
    ];


    /**
     * Retorna Imoveis do usuario
     *
     * @return Alunos
     */
    static function all($columns = ['*'])
    {
        return parent::where('status',1)->get();
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
