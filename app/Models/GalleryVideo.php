<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GalleryVideo extends Model
{
    use HasFactory;
    protected $table = 'gallery_video';


    protected $fillable = [
        'category_id',
        'videos',
    ];

    public function category()
{
    return $this->belongsTo(Category::class);
}
}
