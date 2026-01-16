<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\Category;
use App\Models\Supplier;

/**
 * Class Product
 *
 * Merepresentasikan data produk dalam inventaris.
 *
 * @package App\Models
 */
class Product extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'category_id',
        'supplier_id',
        'name',
        'description',
        'price',
        'stock',
        'image',
    ];

    /**
     * Akses url gambar produk.
     *
     * Mengembalikan URL gambar yang diunggah atau gambar placeholder jika tidak ada gambar.
     *
     * @return string
     */
    public function getImageUrlAttribute()
    {
        if ($this->image) {
            return asset('storage/' . $this->image);
        }
        return asset('images/placeholder-product.png');
    }

    /**
     * Mendapatkan kategori dari produk ini.
     * Relasi: Belongs-To (Setiap produk memiliki satu kategori)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Mendapatkan pemasok (supplier) dari produk ini.
     * Relasi: Belongs-To (Setiap produk dipasok oleh satu supplier)
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
