<?php

namespace App\Http\Controllers;

use App\Http\Requests\StorePizzaRequest;
use App\Http\Requests\UpdatePizzaRequest;
use App\Models\Pizza;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;



class PizzaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pizza.index', [
            'pizzas' => Pizza::paginate(5),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pizza.create',[
            'pizza' => (new Pizza())

        ]);    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StorePizzaRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StorePizzaRequest $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required",
            "size" => "required",

        ]);

   // check if an image exists
   if ($request->has('image')) {

    // Save the file and get the path
    $path = $request
        ->file('image')
        ->store('image/' . $pizza->id, 'public');

    // update the pizza image
    $pizza->update([
        'image' => $path
    ]);
}

   // set the success message to the session
   session()->flash('success', 'Pizza ' . $pizza->name . ' created successfully');

   // redirect to user page
   return redirect()->route('pizza.index');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function show($pizza_id)
    {
        return view('pizza.show', [
            'pizza' => (new Pizza())->findOrFail($pizza_id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function edit(Pizza $pizza)
    {
        return view('pizza.edit', [
            'pizza' => $pizza
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdatePizzaRequest  $request
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function update(UpdatePizzaRequest $request, Pizza $pizza)
    {
        $validated = $request->validate([
            "name" => "required|string|max:255",
            "description" => "required",
            "size" => "required",
            "price" => "required",
         ]);
            // dd($request);
        // update pizza
        $pizza->update($validated);

          // check if an image exists
          if ($request->has('image')) {

            // check if the pizza already has an image and remove it
            if ($pizza->image) {
                Storage::disk('public')->delete($pizza->image);
            }

            // Save the file and get the path
            $path = $request
                ->file('image')
                ->store('images/' . $pizza->id, 'public');

            // update the pizza image
            $pizza->update([
                'image' => $path
            ]);
        }

        //setting success message for the session
        session()->flash('success', 'Pizza details have been updated successfully');

        // redirect to user page
        return redirect()->route('pizza.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pizza  $pizza
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pizza $pizza)
    {
        // delete pizza
        $pizza->delete();

        // set the success message to the session
        session()->flash('success', 'Pizza item has been deleted successfully');

        // redirect to pizza list page
        return redirect()->route('pizza.index');    }
}
