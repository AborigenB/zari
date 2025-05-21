<?php

namespace App\Http\Controllers;

use App\Models\Basket;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function create()
    {
        $user = Auth::user();
        $baskets = Basket::where('user_id', $user->id)->with('art')->get();
        return view('pages.auth.profile.variants.order.create', compact('baskets', 'user'));
    }

    public function store(Request $request)
    {
        $user = Auth::user();
        $baskets = Basket::where('user_id', $user->id)->with('art')->get();

        if ($baskets->isEmpty()) {
            return redirect()->back()->with('error', 'Корзина пуста');
        }

        $order = Order::create([
            'user_id' => $user->id,
            'total_price' => $baskets->sum(function ($basket) {
                return $basket->art->price;
            }),
        ]);

        foreach ($baskets as $basket) {
            OrderItem::create([
                'order_id' => $order->id,
                'art_id' => $basket->art_id,
                'price' => $basket->art->price,
            ]);
            $basket->art->update(['status' => 'Продано']);
        }

        Basket::where('user_id', $user->id)->delete();

        return redirect()->route('profile.show', $user->id)->with('success', 'Заказ оформлен');
    }

    public function updateStatus(Request $request, $id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status' => $request->input('status')]);
        return redirect()->back()->with('success', 'Статус заказа обновлен.');
    }
}
