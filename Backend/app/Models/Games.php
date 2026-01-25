<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    //

    public function topUpPackages()
    {
        return $this->hasMany(TopUpPackage::class, 'game_id');
    }
}
