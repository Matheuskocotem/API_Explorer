<?php

namespace App\Models;

use App\Http\Controllers\ExplorerController;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    protected $fillable = ['name', 'value', 'latitude', 'longitude'];

    public function explorers()
    {
        return $this->belongsToMany(ExplorerController::class, 'explorer_item', 'item_id', 'explorer_id')
                    ->withTimestamps();
    }
}
