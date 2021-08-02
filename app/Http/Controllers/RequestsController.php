<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Products;
use App\Models\Clients;
use App\Models\Requests;

class RequestsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Products $products, Clients $clients, Requests $requests)
    {
        $this->request = $request;
        $this->products = $products;
        $this->clients = $clients;
        $this->requests = $requests;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['data'] = $this->requests->select('number_request', 'clients.name', 'requests.products_id', 'total', 'requests.created_at')->leftJoin('clients', 'clients.id', '=', 'requests.clients_id')->get();

        return view('requests.index', $this->data);
    }

    public function new()
    {
        $this->data['products'] = $this->products->get();
        $this->data['clients'] = $this->clients->get();

        return view('requests.new', $this->data);
    }

    public function save()
    {
        $this->request->validate([
            'products' => 'required',
            'client' => 'required'
        ]);

        $this->requests->clients_id = $this->request->input('client');
        $this->requests->products_id = implode(',', $this->request->input('products'));
        $this->requests->number_request = uniqid();

        $this->requests->save();

        return redirect('requests');
    }

    public function show($number_request)
    {
        $this->data['data'] = $this->requests->select('number_request', 'clients.name', 'requests.products_id', 'total', 'requests.created_at')->leftJoin('clients', 'clients.id', '=', 'requests.clients_id')->where('number_request', $number_request)->get();

        $products_array = explode(',', $this->data['data'][0]->products_id);

        $this->data['products_array_count'] = array_count_values($products_array);

        $this->data['products'] = $this->products->select('id', 'name', 'value')->whereIn('id', $products_array)->get();

        return view('requests.show', $this->data);
    }
}
