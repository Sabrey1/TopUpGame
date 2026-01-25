<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{

    protected $table = 'orders';

    public function payments()
    {
        return $this->hasMany(Payments::class, 'order_id');
    }
}
