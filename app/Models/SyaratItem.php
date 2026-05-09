<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SyaratItem extends Model
{
    use HasFactory;

    protected $table = 'syarat_items';

    protected $fillable = [
        'order_number',
        'title_en',
        'title_id',
        'description_en',
        'description_id',
        'icon',
        'color',
    ];
}
