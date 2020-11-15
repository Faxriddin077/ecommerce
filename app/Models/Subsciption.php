<?php

namespace App\Models;

use App\Mail\SendSubscriptionMessage;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Subsciption extends Model
{
    protected $fillable = ['email', 'product_id'];

    public function scopeActiveByProductId($query, $product_id)
    {
        return $query->where('status', 0)->where('product_id', $product_id);
    }

    public function product()
    {
        $this->belongsTo(Product::class);
    }

    public static function sendEmailBySubscription(Product $product)
    {
        $subscriptions = Subsciption::activeByPrOductId($product->id)->get();
        foreach ($subscriptions as $subscription){
            Mail::to($subscription->email)->send(new SendSubscriptionMessage($product));
            $subscription->status = 1;
            $subscription->save();
        }
    }
}
