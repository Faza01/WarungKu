<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $primaryKey = 'id_product';
    protected $guarded = ['id_product'];

    public function transaction()
    {
        return $this->hasMany(Transaction::class);
    }
    public function category()
    {
        return $this->belongsTo(Category::class, 'id_category');
    }
}
