<?php

namespace App\Domain\Protocols\Models;

use App\Domain\Books\Models\Book;
use App\Domain\Buyers\Models\Buyer;
use App\Domain\Sellers\Models\Seller;
use Database\Factories\ProtocolFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Protocol extends Model
{
    use HasFactory;
    protected $guarded = ['created_at', 'updated_at'];
    public function book(): BelongsTo
    {
        return $this->belongsTo(Book::class);
    }
    public function buyer(): BelongsTo
    {
        return $this->belongsTo(Buyer::class);
    }
    public function seller(): BelongsTo
    {
        return $this->belongsTo(Seller::class);
    }
    public static  function factory() : ProtocolFactory
    {
        return ProtocolFactory::new();
    }
}
