<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;

    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;

    protected $guarded = [];
    protected $table = 'products';

    // Boşluk İndeksi Algoritması
    public static function search($query)
    {
        return DB::table('products')
            ->select('id', 'name')
            ->whereRaw('MATCH(name) AGAINST(? IN BOOLEAN MODE)', [$query])
            ->get();
    }

    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function categories()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function user()
    {
      return $this->belongsTo(User::class, 'user_id');
    }

    public function brand()
    {
      return $this->belongsTo(Brand::class, 'brand_id');
    }
  
}
