<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class ExplorerItem extends Pivot
{
    protected $table = 'explorer_item';
    protected $fillable = ['explorer_id', 'item_id'];
}
