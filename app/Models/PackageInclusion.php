<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PackageInclusion extends Model
{
    use HasFactory;

    protected $table = 'package_inclusion';

    protected $fillable = [
        'package_id',
        'inclusion_id',
    ];

    public function package()
    {
        return $this->belongsTo(Package::class);
    }

    /**
     * Get the inclusion associated with the package inclusion.
     */
    public function inclusion()
    {
        return $this->belongsTo(Inclusion::class);
    }
}
