<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Player;
use App\Game;

use Artisan;

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
        $query = new Game;

        // filters        
        if($request->has('player') && $request->player)
        {
            $name = Player::find($request->player)->name;
            $query = $query->where('winner_id', $request->player);
        }
        else {
            $name = 'All';
        }

        $wins = $query->count();


        return view('home', [
            'items' => [
                'name' => $name,
                'wins' => $wins
            ],
            'players' => Player::all()
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

    /**
     * Upload the file.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function importFile(Request $request)
    {
        $file = $request->file('hands');
        $path = $file->getPathName();
        try {
            Artisan::call("import:hands $path");
        }
        catch(\Exception $e) {
            return view('import', ['error' => true]);
        }

        return view('import', ['success' => true]);
    }
}
