<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Product;

/**
 * Class Purchase
 *
 * Merepresentasikan transaksi pembelian dalam aplikasi.
 *
 * @package App\Models
 */
class Purchase extends Model
{
    /**
     * Atribut yang dapat diisi secara massal.
     *
     * @var array
     */
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'price',
        'total_amount',
        'status',
        'payment_proof',
    ];

    /**
     * Akses URL bukti pembayaran.
     *
     * Mengembalikan URL bukti pembayaran yang diunggah atau null jika tidak ada bukti.
     *
     * @return string|null
     */
    public function getProofUrlAttribute()
    {
        return $this->payment_proof ? asset('storage/' . $this->payment_proof) : null;
    }

    /**
     * Mendapatkan user yang melakukan pembelian.
     * Relasi: Belongs-To
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Mendapatkan produk yang dibeli.
     * Relasi: Belongs-To
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
