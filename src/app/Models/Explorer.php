<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Explorer extends Model
{
    protected $fillable = ['name', 'age', 'latitude', 'longitude'];

    public function items()
    {
        return $this->belongsToMany(Item::class, 'explorer_item')->withTimestamps();
    }
}

