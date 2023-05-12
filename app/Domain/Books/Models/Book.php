<?php

namespace App\Domain\Books\Models;

use App\Domain\Protocols\Models\Protocol;
use Database\Factories\BookFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Book extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function protocols(): HasMany
    {
        return $this->hasMany(Protocol::class);
    }
    public static  function factory() : BookFactory
    {
        return BookFactory::new();
    }
}
