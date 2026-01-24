<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payments extends Model
{
    use HasFactory;

   protected $fillable = [
    'order_id',
    'payment_type_id',
    'amount',
    'transaction_reference',
    'status',
    'paid_at'
];

}
