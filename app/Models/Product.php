<?php

namespace App\Models;

use App\Models\Traits\Translatable;
use App\Services\CurrencyConversation;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use SoftDeletes, Translatable;

    protected $fillable = [
//        'code', 'name', 'description', 'category_id', 'image', 'price', 'hit', 'new', 'recommend', 'count', 'name_en', 'description_en'
    ];

    protected $guarded = [];

    public function getCategory()
    {
        return Category::where('id', $this->category_id)->first();
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getPriceForCount()
    {
        if (!is_null($this->pivot)) {
            return $this->pivot->count * $this->price;
        }
        return $this->price;
    }

    public function scopeByCode($query, $code)
    {
        return $query->where('code', $code);
    }

    public function scopeHit($query)
    {
        return $query->where('new', 1);
    }

    public function scopeNew($query)
    {
        return $query->where('hit', 1);
    }

    public function scopeRecommend($query)
    {
        return $query->where('recommend', 1);
    }

    public function setHitAttribute($value)
    {
        $this->attributes['hit'] = $value === 'on' ? 1 : 0;
    }

    public function setNewAttribute($value)
    {
        $this->attributes['new'] = $value === 'on' ? 1 : 0;
    }

    public function setRecommendAttribute($value)
    {
        $this->attributes['recommend'] = $value === 'on' ? 1 : 0;
    }

    public function isAvailable()
    {
        return !$this->trashed() && $this->count > 0;
    }

    public function isHit()
    {
        return $this->hit === 1;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isRecommend()
    {
        return $this->recommend === 1;
    }

    public function getPriceAttribute($value)
    {
        return round(CurrencyConversation::convert($value), 2);
    }
}
