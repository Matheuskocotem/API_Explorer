<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\ExplorerLocationHistory;

class Explorer extends Model
{
    protected $fillable = ['name', 'age', 'latitude', 'longitude'];

    public function locationHistories()
    {
        return $this->hasMany(ExplorerLocationHistory::class);
    }

    public function updateLocation($latitude, $longitude)
    {
        $this->latitude = $latitude;
        $this->longitude = $longitude;
        $this->save();

        $this->locationHistories()->create([
            'latitude' => $latitude,
            'longitude' => $longitude,
        ]);
    }
}


