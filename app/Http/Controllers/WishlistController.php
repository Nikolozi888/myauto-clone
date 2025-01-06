<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\Wishlist;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id' => 'nullable|integer',
            'brand' => 'required|string',
            'model' => 'required|string',
            'user_id' => 'nullable|string',
            'car_id' => 'nullable|string',
            'year' => 'nullable|string',
            'price' => 'nullable|string',
            'thumbnail' => 'nullable|string',
        ]);

        Wishlist::create($validated);

        return redirect()->back();
    }


    public function destroy($id)
    {

        Wishlist::find($id)->delete();


        return redirect()->back();

    }
}
