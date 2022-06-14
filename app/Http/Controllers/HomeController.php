<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;
use Illuminate\Http\Request;
use App\Models\Pizza;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if($request->pizza){
            $pizzas = \App\Models\Pizza::where($pizza ->size);

            // dd($request);
        }
        $pizzas = Pizza::paginate(10);

        $pizzas = (new Pizza())
        ->newQuery()
        ->where('is_active', 1)
        ->orderBy('is_active', 'asc')
        ->get();


        return view('home', [
            'pizzas' => $pizzas,
        ]);

 }
}
