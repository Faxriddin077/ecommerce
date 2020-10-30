<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'code', 'name', 'description', 'category_id', 'image', 'price', 'hit', 'new', 'recommend'
    ];

    public function getCategory(){
        return Category::where('id', $this->category_id)->first();
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount(){
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function setHitAttribute($value){
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }
    public function setNewAttribute($value){
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }
    public function setRecommendAttribute($value){
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }
    public function isHit(){
        return $this->hit === 1;
    }

    public function isNew(){
        return $this->new === 1;
    }
    public function isRecommend(){
        return $this->recommend === 1;
    }
}
