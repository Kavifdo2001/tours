<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Videos extends Model
{
    use HasFactory;

    protected $table = 'videos';

  
    protected $fillable = [
        'package_id',
        'video'
    ];


    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }
}
