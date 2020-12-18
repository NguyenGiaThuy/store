<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Catalog extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'catalog_name',
    ];

    public function products() {
        return $this->hasMany(Product::class);
    }
}
