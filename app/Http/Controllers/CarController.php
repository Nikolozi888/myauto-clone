<?php

namespace App\Http\Controllers;

use App\Models\Brand;
use App\Models\Car;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;

class CarController extends Controller
{
    public function index()
    {
        $cars = Car::latest()->get();
        $brands = Brand::latest()->get();
        return view('cars.index', compact('cars', 'brands'));
    }

    public function show($id)
    {
        $car = Car::findOrFail($id);
        return view('cars.show', compact('car'));
    }

    public function store(Request $request)
    {
        $attributes = $request->validate([
            'brand_id' => 'required|exists:brands,id',
            'model_id' => 'required|exists:models,id',
            'thumbnail' => 'required|image',
            'year' => 'required|integer',
            'description' => 'required',
            'price' => 'nullable|numeric',
            'mileage' => 'nullable|numeric',
            'fuel_type_id' => 'required|exists:fuel_types,id',
            'gearbox_id' => 'required|exists:gearboxes,id',
            'body_type_id' => 'required|exists:body_types,id',
            'author_id' => 'required|exists:users,id',
            'images' => 'nullable|array',
            'images.*' => 'mimes:png,jpg,jpeg|max:2048'
        ]);

        $current_timestamp = Carbon::now()->timestamp;

        if ($request->hasFile('thumbnail')) {
            $uniqueName = uniqid() . '-' . $request->file('thumbnail')->getClientOriginalName();
            $thumbnailPath = $request->file('thumbnail')->storeAs('images', $uniqueName, 'public');
            $attributes['thumbnail'] = $thumbnailPath;
        }

        $gallery_images = [];
        if ($request->hasFile('images')) {
            foreach ($request->file('images') as $index => $file) {
                $file_name = $current_timestamp . "-" . ($index + 1) . '.' . $file->extension();
                $path = $file->storeAs('images', $file_name, 'public');
                $gallery_images[] = $path;
            }
        }

        $attributes['images'] = implode(',', $gallery_images);

        Car::create($attributes);

        return redirect()->route('index')->with('success', 'მანქანა წარმატებით დაემატა!');
    }

    public function cars($id) {
        $cars = User::find($id)->cars;
        $brands = Brand::latest()->get();
        return view('cars.index', compact('cars', 'brands'));
    }

}
