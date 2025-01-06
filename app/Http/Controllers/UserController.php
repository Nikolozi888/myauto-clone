<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Models;
use App\Models\User;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request) {

        $user = User::find(auth()->id());

        $brands = Brand::all();

        $models = Models::where('brand_id', $request->filled('brand'))->get();

        return view('profiles.user',[
            'user' => $user,
            'brands' => $brands,
            'models' => $models
        ]);
    }
}
