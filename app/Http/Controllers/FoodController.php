<?php

namespace App\Http\Controllers;

use App\Models\Food;
use Illuminate\Http\Request;

class FoodController extends Controller
{
   public function index (){
    $menu=Food::all();
    return view('dashboard',compact('menu'));
   }
   public function create (){
    return view('menu.create');
   }
   public function store(Request $request)
{
    $request->validate([
        'name' => 'required',
        'description' => 'required',
        'price' => 'required|numeric',
        'image' => 'image|mimes:jpeg,png,jpg,gif,svg',
    ]);

    $menu = new Food($request->all());

    if ($request->hasFile('image')) {
        $imagePath = $request->file('image')->store('menu_images', 'public');
        $menu->image = $imagePath;
    }

    $menu->save();
    return redirect()->route('dashboard');
    }   

   public function edit(Food $food){
    return view('menu.edit',compact('food'));
   }
   public function update(Request $request,Food $food){
    $request->validate([
        'name'=>'required',
        'description'=>'required',
        'price'=>'required|numeric',
        'image'=>'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
    ]);
    $food->update($request->all());
    if($request->hasFile('image')){
        $imagePath=$request->file('image')->store('menu_images','public');
        $food->image=$imagePath;
    }
    $food->save();
    return redirect()->route('dashboard');
   }
   public function destroy(Food $food){
    $food->delete();
    return redirect()->route('dashboard');
   }
}
