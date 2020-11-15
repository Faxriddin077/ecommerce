<?php

namespace App\Observers;

use App\Models\Product;
use App\Models\Subsciption;

class ProductObserver
{

    public function updating(Product $product)
    {
        $oldCount = $product->getOriginal('count');
        if ($oldCount == 0 && $product->count > 0){
            Subsciption::sendEmailBySubscription($product);
        }
    }
}
