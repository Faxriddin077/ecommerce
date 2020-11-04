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
        $orderId = session('orderId');
        if (!is_null($orderId) && Order::getFullPrice() > 0) {
                return $next($request);
        }
        session()->flash('warning', "Korzinada mahsulot yo'q");
        return redirect()->route('index');
    }
}
