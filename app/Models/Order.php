<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id'];
    public function products()
    {
        return $this->belongsToMany(Product::class)->withPivot('count')->withTimestamps();
    }

    public function scopeActive($query){
        return $query->where('status', 1);
    }

    public function calculateFullPrice(){
        $sum = 0;
        foreach ($this->products()->withTrashed()->get() as $product){
            $sum += $product->getPriceForCount();
        }
        return $sum;
    }

    public static function eraseOrderPrice(){
        session()->forget('full_order_price');
    }

    public static function changeFullPrice($changePrice){
        $sum = self::getFullPrice() + $changePrice;
        session(['full_order_price' => $sum]);
    }

    public static function getFullPrice(){
        return session('full_order_price', 0);
    }

    public function saveOrder($name, $phone){
        if ($this->status == 0) {
            $this->name = $name;
            $this->phone = $phone;
//            $this->email = $email;
            $this->status = 1;
            $this->save();
            session()->forget('orderId');
            return true;
        }
        else{
            return false;
        }
    }
}
