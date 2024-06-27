<?php

namespace App\Models;

use App\Http\Controllers\ExplorerController;
use Illuminate\Database\Eloquent\Model;

class ExplorerLocationHistory extends Model
{
        protected $table = "explorer_locations_history";
        protected $fillable = ['explorer_id', 'latitude', 'longitude'];

        public function explorer()
        {
            return $this->belongsTo(Explorer::class, 'explorer_id', 'id');
        }
}


