<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePizzaAddonRequest;
use App\Http\Requests\UpdatePizzaAddonRequest;
use App\Models\PizzaAddon;

class PizzaAddonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePizzaAddonRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePizzaAddonRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\PizzaAddon  $pizzaAddon
     * @return \Illuminate\Http\Response
     */
    public function show(PizzaAddon $pizzaAddon)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\PizzaAddon  $pizzaAddon
     * @return \Illuminate\Http\Response
     */
    public function edit(PizzaAddon $pizzaAddon)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePizzaAddonRequest  $request
     * @param  \App\Models\PizzaAddon  $pizzaAddon
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePizzaAddonRequest $request, PizzaAddon $pizzaAddon)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\PizzaAddon  $pizzaAddon
     * @return \Illuminate\Http\Response
     */
    public function destroy(PizzaAddon $pizzaAddon)
    {
        //
    }
}
