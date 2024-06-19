<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = 'products';

    protected $fillable = [
        'text',
        'category_id',
        'update_id', 
        'media_group_id', 
        'product_details'
    ];

    protected $casts = [
        'text' => 'array', 
    ];

    public function images()
    {
        return $this->hasMany(Image::class, 'product_id', 'id');
    }

    public function category()
    {
        return $this->hasOne(Category::class, 'id', 'category_id');
    } 


}
