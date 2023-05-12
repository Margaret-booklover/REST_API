<?php

namespace App\Domain\Sellers\Models;

use App\Domain\Protocols\Models\Protocol;
use Database\Factories\SellerFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Seller extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function protocols(): HasMany
    {
        return $this->hasMany(Protocol::class);
    }
    public static  function factory() : SellerFactory
    {
        return SellerFactory::new();
    }
}
