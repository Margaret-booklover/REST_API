<?php

namespace App\Domain\Buyers\Models;

use App\Domain\Protocols\Models\Protocol;
use Database\Factories\BuyerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Buyer extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function protocols(): HasMany
    {
        return $this->hasMany(Protocol::class);
    }
    public static  function factory() : BuyerFactory
    {
        return BuyerFactory::new();
    }
}
