<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = ["id_product", "id_user", "address", "qty", "payment", "total_price"];
    protected $with = [
        'product',
        'user'
    ];
    public function product()
    {
        return $this->belongsTo(Product::class, 'id_product');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }
}
