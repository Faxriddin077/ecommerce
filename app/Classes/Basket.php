<?php

namespace App\Classes;

use App\Mail\OrderCreated;
use App\Models\Order;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class Basket
{
    protected $order;

    /**
     * Basket constructor.
     * @param bool $createOrder
     */
    public function __construct($createOrder = false)
    {
        $orderId = session('orderId');
        if (is_null($orderId) && $createOrder) {
            $data = [];
            if (Auth::check()) {
                $data['user_id'] = Auth::id();
            }
            $order = Order::create($data);
            session(['orderId' => $order->id]);
        }else{
            $order = Order::findOrFail($orderId);
        }

        $this->order = Order::findOrFail($orderId);
    }

    /**
     * @return mixed
     */
    public function getOrder()
    {
        return $this->order;
    }

    public function countAvailable($updateCount = false){
        foreach ($this->order->products as $orderProduct) {
            if($orderProduct->count < $this->getPivotRow($orderProduct)->coun) return false;
            if ($updateCount){
                $orderProduct->count -= $this->getPivotRow($orderProduct)->count;
            }
        }
        if ($updateCount) $this->order->products->map->save();

        return true;
    }

    public function saveOrder($name, $phone, $email){
        if (!$this->countAvailable(true)) return false;
        Mail::to($email)->send(new OrderCreated($name, $this->order));
        return $this->order->saveOrder($name, $phone);
    }

    public function getPivotRow($product){
        return $this->order->products()->where('product_id', $product->id)->first()->pivot;
    }

    public function addProduct(Product $product){
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            $pivotRow->count++;
            if($pivotRow->count > $product->count) return false;
            $pivotRow->update();
        }else{
            if ($product->count == 0) return false;
            $this->order->products()->attach($product->id);
        }

        Order::changeFullPrice($product->price);
        return true;
    }

    public function removeProduct(Product $product){
        if ($this->order->products->contains($product->id)) {
            $pivotRow = $this->getPivotRow($product);
            if ($pivotRow->count < 2) {
                $this->order->products()->detach($product->id);
            }
            $pivotRow->count--;
            $pivotRow->update();
        }
        Order::changeFullPrice(-$product->price);
    }




}