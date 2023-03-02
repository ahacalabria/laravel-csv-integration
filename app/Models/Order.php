<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Order extends Model
{
    use HasFactory;

    /**
     * The items that belong to the order.
     */
    public function items(): BelongsToMany
    {
        return $this->belongsToMany(Item::class);
    }
}
