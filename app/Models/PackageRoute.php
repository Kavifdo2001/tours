<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageRoute extends Model
{
    use HasFactory;

    protected $fillable = [
        'package_id',
        'route_id',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the route associated with the package route.
     */
    public function route()
    {
        return $this->belongsTo(Route::class);
    }
}
