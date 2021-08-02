<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;

class ProductsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Products $products)
    {
        $this->request = $request;
        $this->products = $products;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['data'] = $this->products->get();
        return view('products.index', $this->data);
    }

    public function new()
    {
        return view('products.new');
    }

    public function save()
    {
        $this->request->validate([
            'name' => 'required',
            'value' => 'required',
        ]);

        $this->products->name = $this->request->input('name');
        $this->products->value = substr_replace(preg_replace('/\D/', '', $this->request->input('value')), '.', -2, 0);

        $this->products->save();

        return redirect('products');
    }
}
