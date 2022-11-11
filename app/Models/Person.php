<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = 'people';
    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';


    /**
     * Retorna todos os cliente do usuario
     * @return Person
     */
    public function getAllPeople(){
        $usuario = auth()->user();
        $people = Person::where('user_id', $usuario->id)->get();
        return $people;
    }


}
