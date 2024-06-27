<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'value', 'latitude', 'longitude'];

    public function explorers()
    {
        return $this->belongsToMany(Explorer::class, 'explorer_item')->withTimestamps();
    }
}
