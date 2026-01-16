<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

/**
 * Class Supplier
 *
 * Merepresentasikan pemasok (supplier) produk.
 *
 * @package App\Models
 */
class Supplier extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'contact_person',
        'phone',
        'email',
        'address',
    ];

    /**
     * Mendapatkan produk yang disediakan oleh supplier ini.
     * Relasi: One-to-Many
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }
}
