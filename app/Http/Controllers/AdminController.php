<?php

namespace App\Http\Controllers;

use App\Models\BodyType;
use App\Models\Brand;
use App\Models\FuelType;
use App\Models\Gearbox;
use App\Models\Models;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    public function index() {

        $admin = User::find(auth()->id());

        return view('profiles.admin',[
            'admin' => $admin
        ]);
    }

    public function brandStore(Request $request){
        $attributes = $request->validate([
            'name' => 'required|max:255',
        ]);

        Brand::create($attributes);

        return redirect()->back()->with('success','მანქანის ბრენდი წარმატებით დაემატა');
    }

    public function FuelTypeStore(Request $request){
        $attributes = $request->validate([
            'name' => 'required|max:255',
        ]);

        FuelType::create($attributes);

        return redirect()->back()->with('success','მანქანის საწვავის ტიპი წარმატებით დაემატა');
    }

    public function GearboxStore(Request $request){
        $attributes = $request->validate([
            'name' => 'required|max:255',
        ]);

        Gearbox::create($attributes);

        return redirect()->back()->with('success','მანქანის გადაცემათა კოლოფის ტიპი წარმატებით დაემატა');
    }

    public function BodyTypeStore(Request $request){
        $attributes = $request->validate([
            'name' => 'required|max:255',
        ]);

        BodyType::create($attributes);

        return redirect()->back()->with('success','მანქანის ტიპი წარმატებით დაემატა');
    }

    public function ModelStore(Request $request){
        $attributes = $request->validate([
            'brand_id' => 'required',
            'name' => 'required'
        ]);

        Models::create($attributes);

        return redirect()->back()->with('success','მანქანის მოდელი წარმატებით დაემატა');
    }








    public function brandDestroy($id){
        Brand::find($id)->delete();

        return redirect()->back()->with('success','მანქანის ბრენდი წაიშალა');
    }

    public function FuelTypeDestroy($id){
        FuelType::find($id)->delete();

        return redirect()->back()->with('success','მანქანის საწვავის ტიპი წაიშალა');
    }

    public function GearboxDestroy($id){
        Gearbox::find($id)->delete();

        return redirect()->back()->with('success','მანქანის გადაცემათა კოლოფის ტიპი წაიშალა');
    }

    public function BodyTypeDestroy($id){
        BodyType::find($id)->delete();

        return redirect()->back()->with('success','მანქანის ტიპი წაიშალა');
    }

    public function ModelDestroy($id){
        Models::find($id)->delete();

        return redirect()->back()->with('success','მანქანის მოდელი წაიშალა');
    }
}
