<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubSubCategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'sub_subcategory_name_en',
        'sub_subcategory_name_ur',
        'sub_subcategory_slug_en',
        'sub_subcategory_slug_ur',        
    ];

    public function Category(){
        return $this->belongsTo(Category::class , 'category_id' , 'id');
    }

    public function SubCategory(){
        return $this->belongsTo(SubCategory::class , 'subcategory_id' , 'id');
    }
}
