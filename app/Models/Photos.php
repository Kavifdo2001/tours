<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Photos extends Model
{
    use HasFactory;
    protected $table = 'photos';

    // Define the fillable fields (mass assignment)
    protected $fillable = [
        'package_id',
        'main_image',
        'other_images'
    ];

    public function package()
    {
        return $this->belongsTo(Package::class, 'package_id');
    }

    // public function getOtherImagesAttribute($value)
    // {
    //     return explode(',', $value);
    // }
    // public function setOtherImagesAttribute($value)
    // {
    //     $this->attributes['other_images'] = implode(',', $value);
    // }

}
