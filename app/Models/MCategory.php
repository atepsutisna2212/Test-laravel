<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MCategory extends Model
{
    use HasFactory;
    protected $table = 'tb_category_product';
    protected $primaryKey = 'id_category';
    protected $guard = 'id_category';
    protected $fillable = ['name'];
}
