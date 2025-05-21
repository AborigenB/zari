<?php

namespace App\Http\Controllers;

use App\Models\Art;
use App\Models\Basket;
use Illuminate\Http\Request;

class BasketController extends Controller
{
    public function addToBasket(Request $request, $id)
    {
        $art = Art::findOrFail($id);
        Basket::updateOrCreate(
            ['user_id' => auth()->user()->id, 'art_id' => $art->id],
            ['user_id' => auth()->user()->id, 'art_id' => $art->id]
        );
        return redirect()->back()->with('success', 'Арт добавлен в корзину');
    }

    public function removeFromBasket($id)
    {
        $art = Art::findOrFail($id);
        Basket::where('user_id', auth()->user()->id)->where('art_id', $art->id)->delete();
        return redirect()->back()->with('success', 'Арт удален из корзины');
    }
}
