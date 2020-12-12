<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Food;
class FoodController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $foods = Food::latest()->paginate(1);
        return view('food.index',compact('foods'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        return view('food.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'category_id'=>'required',
            'image'=>'required',
            'image.*'=>'image|mimes:jpg,jpeg,png'
        ]);
        $image = $request->file('image');
        $name = uniqid().'.'.$image->getClientOriginalExtension();
        $destnationPath = public_path('/images');
        $image->move($destnationPath,$name);
        Food::create([
            'name'=>$request->get('name'),
            'description'=>$request->get('description'),
            'price'=>$request->get('price'),
            'category_id'=>$request->get('category_id'),
            'image'=> $name // I think it'better to store full pth to file
        ]);
        return redirect()->back()->with('message','Food created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
        $food =Food::find($id);
        return view('food.edit',compact('food'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
        $this->validate($request,[
            'name'=>'required',
            'description'=>'required',
            'price'=>'required|integer',
            'category_id'=>'required',
            //the image is optional
            'image'=>'mimes:jpg,jpeg,png'
        ]);
        $food =Food::find($id);
        $name = $food->image;
        if($request->hasFile('image')){
            $image = $request->file('image');
            $name = uniqid().'.'.$image->getClientOriginalExtension();
            $destnationPath = public_path('/images');
            $image->move($destnationPath,$name);
        }
        $food->name = $request->get('name');
        $food->description = $request->get('description');
        $food->price = $request->get('price');
        $food->category_id = $request->get('category_id');
        $food->image = $name;

        $food->save();
        return redirect()->route('food.index')->with('message','Food Updated');


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
        $food =Food::find($id);
        $food->delete();
        return redirect()->route('food.index')->with('message','food deleted');
    }
}
