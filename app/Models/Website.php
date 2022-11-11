<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Website extends Model
{
    use HasFactory;
    protected $table = 'websites';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'domain',
        'company_id'
    ];

    public function companies(){
        return $this->belongsTo(Company::class,'company_id','uuid');
    }

    public function imoveis(){
        return $this->hasMany(Imovel::class,'website_id', 'uuid');
    }
}
