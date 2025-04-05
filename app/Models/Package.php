<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'type',
        'category_id',
        'subcategory_id',
        'air_ticket_id',
        'departure_id',
        'route_id',
        'inclusion_id',
        'amount',
        'currency',
        'no_of_days',
        'pdf_document',
        'main_image',
        'additional_images',
        'guide_id',
        'requests',
        'description',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function subcategory()
    {
        return $this->belongsTo(Category::class, 'subcategory_id');
    }


    public function airTicket()
    {
        return $this->belongsTo(AirTicket::class);
    }

    public function departure()
    {
        return $this->belongsTo(Diparture::class);
    }


    public function routes()
    {
        return $this->belongsToMany(Route::class, 'package_routes');
    }

    public function inclusions()
    {
        return $this->belongsToMany(Inclusion::class, 'package_inclusion');
    }

    public function guide()
    {
        return $this->belongsTo(User::class, 'guide_id')->where('type', 2);
    }

    public function photos()
{
    return $this->hasOne(Photos::class);
}

public function videos()
{
    return $this->hasMany(Videos::class);
}


}
