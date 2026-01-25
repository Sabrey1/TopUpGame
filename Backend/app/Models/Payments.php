<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'topup_package_id',
        'md5',
        'payment_type_id',
        'amount',
        'transaction_reference',
        'status',
        'paid_at'
    ];


    public function topUpPackage()
    {
        return $this->belongsTo(TopUpPackage::class, 'topup_package_id');
    }
    public function order()
    {
        return $this->belongsTo(Orders::class, 'order_id');
    }


}
