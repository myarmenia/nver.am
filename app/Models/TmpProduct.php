<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TmpProduct extends Model
{
    use HasFactory;

    protected $table = 'tmp_products';
    protected $fillable = [
        'link',
        'owner_email',
        'cashback',
        'owner',
        'payment_id',
    ];
}
