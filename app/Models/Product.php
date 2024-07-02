<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Laravel\Scout\Searchable;

class Product extends Model
{
    use HasFactory, Searchable;

    protected $table = 'products';

    protected $fillable = [
        'text',
        'category_id',
        'update_id', 
        'media_group_id', 
        'product_details',
        'top_at'
    ];

    protected $casts = [
        'text' => 'array', 
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function videos()
    {
        return $this->hasMany(Video::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    } 

    public function toSearchableArray()
    {
        $decodedDetails = json_decode($this->product_details, true);

        return [
            'id' => $this['id'],
            'title_am' => $decodedDetails['title_am'],
            'title' => $decodedDetails['title'],
        ];

    }


}
