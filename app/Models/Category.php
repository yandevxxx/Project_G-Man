<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

/**
 * Class Category
 *
 * Merepresentasikan kategori produk dalam aplikasi.
 *
 * @package App\Models
 */
class Category extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = ['name'];

    /**
     * Mendapatkan daftar produk yang termasuk dalam kategori ini.
     * Relasi: One-to-Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
