<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    /** @use HasFactory<\Database\Factories\ProductsFactory> */
    use HasFactory;
    public function categories (){
        return $this->belongsToMany(Category::class);
    }
    public function category (string $name){
        $catigory=Category::firstOrCreate(['name'=>$name]);
        return  $this->categories()->attach($catigory);
    }
    public function order_detail ()
    {
        return $this->hasMany(OrderDetail::class);
    }
    public function getImageUrlAttribute(): string
    {
        return str_starts_with($this->image, 'http') ? $this->image : asset('storage/' . $this->image);
    }
    public function user ()
    {
        return $this->belongsTo(User::class);
    }
    
}
