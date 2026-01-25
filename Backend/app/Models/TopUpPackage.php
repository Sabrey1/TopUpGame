<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopUpPackage extends Model
{
    protected $table = 'topup_packages';

    public function payments()
    {
        return $this->hasMany(Payments::class, 'topup_package_id');
    }
}
