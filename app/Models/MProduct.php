<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MProduct extends Model
{
    use HasFactory;
    protected $table = 'tb_product';
    protected $primaryKey = 'id_product';
    protected $guard = 'id_product';
    protected $fillable = ['category_id', 'name', 'price', 'image'];

    public function category()
    {
        return $this->belongsTo(MCategory::class, 'category_id');
    }
}
