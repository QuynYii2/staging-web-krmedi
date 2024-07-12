<?php

namespace App\Models;

use App\Enums\TypeProductCart;
use App\Models\online_medicine\ProductMedicine;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'product_id',
        'quantity',
        'type_product',
        'type_cart',
        'type_delivery',
        'price',
        'total_price',
        'status',
        'prescription_id',
        'note',
        'treatment_days',
        'remind_remain',
        'doctor_id'
    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function productInfo()
    {
        return $this->belongsTo(ProductInfo::class, 'product_id', 'id');
    }

    public function productMedicine()
    {
        return $this->belongsTo(ProductMedicine::class, 'product_id', 'id');
    }

    public function doctors()
    {
        return $this->belongsTo(User::class, 'doctor_id', 'id');
    }
}
