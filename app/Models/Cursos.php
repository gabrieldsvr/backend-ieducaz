<?php

namespace App\Models;

use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\This;

class Cursos extends Model
{
    use HasFactory;

    public $incrementing = false;
    protected $primaryKey = 'id';
    protected $keyType = 'string';

    protected $table = 'cursos';

    function delete()
    {
        try {
            $this->status = false;
            $this->save();
            return true;
        }catch (\Exception $e){return false;}
    }

    static function all($columns = ['*'])
    {
        return parent::where('status',1)->get();
    }

}
