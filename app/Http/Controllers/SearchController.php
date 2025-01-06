<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\Models;
use Illuminate\Http\Request;

class SearchController extends Controller
{
    public function search(Request $request)
    {
        $query = Car::query();

        if ($request->filled('brand')) {
            $query->where('brand_id', $request->brand);
        }
        if ($request->filled('model')) {
            $query->where('model_id', $request->model);
        }
        if ($request->filled('year_min')) {
            $query->where('year', '>=', $request->year_min);
        }
        if ($request->filled('year_max')) {
            $query->where('year', '<=', $request->year_max);
        }
        if ($request->filled('price_min')) {
            $query->where('price', '>=', $request->price_min);
        }
        if ($request->filled('price_max')) {
            $query->where('price', '<=', $request->price_max);
        }
        if ($request->filled('body_type')) {
            $query->where('body_type_id', $request->body_type);
        }
        if ($request->filled('fuel_type')) {
            $query->where('fuel_type_id', $request->fuel_type);
        }
        if ($request->filled('gearbox')) {
            $query->whereIn('gearbox_id', $request->gearbox);
        }
        if ($request->filled('mileage')) {
            $query->where('mileage', '<=', $request->mileage);
        }

        $cars = $query->get();

        $brands = Brand::all();

        $models = Models::where('brand_id', $request->filled('brand'))->get();


        session([
            'cars' => $cars,
            'search_params' => $request->only([
                'brand',
                'model',
                'year_min',
                'year_max',
                'price_min',
                'price_max',
                'body_type',
                'fuel_type',
                'gearbox',
                'mileage'
            ]),
        ]);


        return view('cars.search', compact('cars', 'brands', 'models'));
    }




    public function getModels(Request $request)
    {
        $request->validate([
            'brand_id' => 'required|integer|exists:brands,id',
        ]);

        $models = Models::where('brand_id', $request->input('brand_id'))->get(['id', 'name']); // Limit fields for efficiency

        return response()->json($models);
    }
}
