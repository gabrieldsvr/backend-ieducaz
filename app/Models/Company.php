<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Company extends Model
{
    use HasFactory;
    protected $table = 'companies';
    protected $primaryKey = 'uuid';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $fillable = [
        'name',
        'document'
    ];

    public function users(): HasMany
    {
        return $this->hasMany(User::class,'company_id', 'uuid');
    }

    public function website(): Model|HasOne|null
    {
        return $this->hasOne(Website::class,'company_id', 'uuid')->first();
    }
}
