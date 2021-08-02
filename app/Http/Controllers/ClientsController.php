<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Clients;

class ClientsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct(Request $request, Clients $clients)
    {
        $this->request = $request;
        $this->clients = $clients;
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $this->data['data'] = $this->clients->get();
        return view('clients.index', $this->data);
    }

    public function new()
    {
        return view('clients.new');
    }

    public function save()
    {
        $this->request->validate([
            'name' => 'required',
            'phone' => 'required|min:14|max:15',
            'birth-date' => 'required|date|min:10|max:10',
        ]);

        $this->clients->name = $this->request->input('name');
        $this->clients->phone = $this->request->input('phone');
        $this->clients->birth_date = implode('-', array_reverse(explode('-', $this->request->input('birth-date'))));

        $this->clients->save();

        return redirect('clients');
    }
}
