<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopUpPackage extends Model
{
    protected $table = 'topup_packages';

    protected $fillable = [
        'game_id',
        'name',
        'description',
        'image',
        'amount',
        'unit_id',
        'discount',
        'price',
        'fullprice',
        'best_seller',
        'currency_id',
    ];

    public function game()
    {
        return $this->belongsTo(Games::class, 'game_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'topup_package_id');
    }

    public function unit()
    {
        return $this->belongsTo(Unit::class, 'Unit');
    }

    public function currency()
    {
        return $this->belongsTo(Currency::class, 'currency');
    }
}
