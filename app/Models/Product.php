<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @method static create(array $array)
 */
class Product extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'product_name',
        'brand',
        'price',
        'type',
        'image',
        'catalog_id',
    ];

    public function catalog() {
        return $this->belongsTo(Catalog::class);
    }

    public function orders() {
        return $this->belongsToMany(Order::class)->withPivot('sub_total', 'quantity');;
    }
}
