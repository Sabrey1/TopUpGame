<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TopUpPackage extends Model
{
    protected $table = 'topup_packages';

    public function game()
    {
        return $this->belongsTo(Games::class, 'game_id');
    }

    public function payments()
    {
        return $this->hasMany(Payments::class, 'topup_package_id');
    }
}
