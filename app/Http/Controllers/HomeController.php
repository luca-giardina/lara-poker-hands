<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Order;
use App\Client;
use App\Deal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        $query = new Order;

        // filters        
        if($request->has('client') && $request->client)
        {
            $query = $query->where('client_id', $request->client);
        }
        if($request->has('deal') && $request->deal)
        {
            $query = $query->where('deal_id', $request->deal);
        }

        $query = $query->get();

        $clients = Client::all();
        $deals = Deal::all();

        // no filters
        $result = [
            [
                'accepted' => $query->sum("accepted"),
                'refused' => $query->sum("refused")
            ]
        ];


        return view('home', [
            'clients' => $clients,
            'deals' => $deals,
            'items' => $result
        ]);
    }

    /**
     * Show the application import.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function import()
    {
        return view('import');
    }
}
