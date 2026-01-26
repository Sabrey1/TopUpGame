<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Games extends Model
{
    //
    protected $fillable = ['name','slug','image','is_popular','is_new','is_active'];

    public function topUpPackages()
    {
        return $this->hasMany(TopUpPackage::class, 'game_id');
    }
}
