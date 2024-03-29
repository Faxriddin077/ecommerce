<?php

namespace App\Http\Middleware;

use App\Models\Order;
use Closure;
use Illuminate\Http\Request;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  Request  $request
     * @param  Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $order = session('order');
        if (!is_null($order) && $order->getFullPrice() > 0) {
                return $next($request);
        }
        session()->forget('order');
        session()->flash('warning', __('basket.cart_is_empty'));
        return redirect()->route('index');
    }
}
