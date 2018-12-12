<?php

namespace App\Http\Controllers;

use App\Menu;
use App\Product;
use Illuminate\Http\Request;

class FormProceedingAction extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $this->validate($request,[
            'name'        => 'required|min:4|max:255|unique:products,name',
            'description' => 'required',
            'image'       => 'image|mimes:jpeg,jpg,png'
        ]);

        $product = new Product;
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->image = $request->input('description');
        $product->menu_id = $request->input('menu');

        $image = $request->image;
        if ($image) {
            $imageName = $image->getClientOriginalName();
            $image->move('images', $imageName);

            $product->image = 'http://dev.pizzaro.com/images/' . $imageName;
        }

        $product->save();

        return view('admin.form', ['menu' => Menu::all()]);
    }
}
