<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCartRequest;
use App\Http\Requests\UpdateCartRequest;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Pizza;
use App\Models\PizzaAddon;
use Illuminate\Http\Request;

class CartController extends Controller
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
     * @param  \App\Http\Requests\StoreCartRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // validate the request
        $validated = $request->validate([
            'pizza_id' => 'required',
            'quantity' => 'required|numeric|min:1',
        ]);

        // create an instance of the pizza
        $pizza = (new Pizza())->findOrFail($validated['pizza_id']);

        // check if a cart exists for this authenticated user
        $cart = Cart::where('user_id', auth()->id())
            ->where('is_paid', false)
            ->first();

        // if the authenticated user has no cart, create one
        if (!$cart) {
            $cart = Cart::create([
                'user_id' => auth()->id(),
                'total' => 0,
                'is_paid' => false,
            ]);
        }

        // check if the pizza is already in the cart and remove
        $cart->pizzas()->detach($pizza->id);

        // calculate pizza total
        $pizza_total = $pizza->price * $validated['quantity'] ;

        // check if there are any addons and add them to the pizza total
        if ($request->pizza_addons) {
            foreach ($request->pizza_addons as $addon) {
                $pizza_total += (new PizzaAddon())->findOrFail($addon)->value * $validated['quantity'];;
            }
        }


        // add the pizza to the cart
        $cart->pizzas()->attach([
            $pizza->id => [
                'quantity' => $validated['quantity'],
                'price' => $pizza->price,
                'total' => $pizza_total,
                'addons' => $request->pizza_addons ? json_encode($request->pizza_addons) : null,
            ]
        ]);

        // loop through the pizzas in the cart and calculate the total
        $cart->total = 0;
        foreach ($cart->pizzas as $pizza) {
            $cart->total += $pizza->pivot->total;
        }
        $cart->save();

        // put the cart ID to the session so that it can be accessible in the view
        session()->put('cart_id', $cart->id);

        return redirect()->route('cart.show', $cart->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, Cart $cart)
    {
        if($cart->is_paid){
            return redirect()->route('home');
        }

        // check if the cart belongs to the authenticated user
        if ($cart->user_id !== $request->user()->id) {
            abort(403, 'Sorry, this cart does not belong to you.');
        }

        return view('cart.show', compact('cart'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function checkout(Request $request, Cart $cart)
    {
        // check if the cart is paid and redirect to the home page
        if ($cart->is_paid) {
            return redirect()->route('home');
        }

        // check if the cart belongs to the authenticated user
        if ($cart->user_id !== $request->user()->id) {
            abort(403, 'Sorry, this cart does not belong to you.');
        }

        // create an order for the cart
        $order = Order::where('cart_id', $cart->id)
            ->where('user_id', $request->user()->id)
            ->first();

        // if the order does not exist, create one
        if (!$order) {
            $order = Order::create([
                'cart_id' => $cart->id,
                'user_id' => $request->user()->id,
                'status' => 'pending',
                'payment_status' => 'pending',
                'total' => $cart->total,
            ]);
        }

        // create an instance of the promotion and check if this promotion is applicable to the cart
        $promotion = (new \App\Models\Promotion())->find($order->promotion_id);

        if ($promotion) {
            // check for the promotion type
            if ($promotion->type == 'number_of_items_validation') {

                // count all the pizzas in the cart
                $count = 0;
                foreach ($cart->pizzas as $pizza) {
                    $count += $pizza->pivot->quantity;
                }

                // check if the promotion has a value and that is equal to the number of items in the cart
                if ($promotion->value == $count) {

                    // attach the promotion ID to the order
                    $order->promotion_id = $promotion->id;

                    // check for the promotion price type and calculate the total
                    if ($promotion->price_type == 'fixed') {

                        $order->total = $cart->total - $promotion->price_value;

                        $order->discount = $cart->total - $order->total;
                    } else if ($promotion->price_type == 'percentage') {

                        $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);

                        $order->discount = $cart->total - $order->total;
                    }

                    // save the order
                    $order->save();

                    session()->flash('promotion_success', $promotion->name . ' applied successfully.');
                } else {

                    $order->total = $cart->total;

                    $order->discount = 0;

                    $order->promotion_id = null;

                    $order->save();

                    session()->flash('error', 'Sorry, ' . $promotion->name . ' promotion is not applicable to your cart.');
                }
            }
        }

        // get all active promotions in the system
        $promotions = \App\Models\Promotion::where('is_active', true)->get();

        return view('cart.checkout', [
            'cart' => $cart,
            'user' => $request->user(),
            'promotions' => $promotions,
            'order' => $order
        ]);
    }

    public function updateOrder(Request $request, Cart $cart, Order $order)
    {
        // check if the request has a promotion id
        $request->validate([
            'promotion_id' => 'required|numeric|exists:promotions,id',
        ]);

        // create an instance of the promotion and check if this promotion is applicable to the cart
        $promotion = (new \App\Models\Promotion())->findOrFail($request->promotion_id);

        // check for the promotion type
        if ($promotion->type == 'number_of_items_validation') {

            // count all the pizzas in the cart
            $count = 0;
            foreach ($cart->pizzas as $pizza) {
                $count += $pizza->pivot->quantity;
            }

            // check if the promotion has a value and that is equal to the number of items in the cart
            if ($promotion->value == $count) {

                // attach the promotion ID to the order
                $order->promotion_id = $promotion->id;

                // check for the promotion price type and calculate the total
                if ($promotion->price_type == 'fixed') {

                    $order->total = $cart->total - $promotion->price_value;

                    $order->discount = $cart->total - $order->total;
                } else if ($promotion->price_type == 'percentage') {

                    $order->total = $cart->total - ($cart->total * $promotion->price_value / 100);

                    $order->discount = $cart->total - $order->total;
                }

                // save the order
                $order->save();

                session()->flash('promotion_success', $promotion->name . ' applied successfully.');
            } else {

                $order->total = $cart->total;

                $order->discount = 0;

                $order->promotion_id = null;

                $order->save();

                session()->flash('error', 'Sorry, ' . $promotion->name . ' promotion is not applicable to your cart.');
            }
        }

        // redirect to the checkout page
        return redirect()->route('cart.checkout', $cart->id);
    }


    public function completeCheckout(Request $request, Cart $cart, Order $order)
    {

        // validate the request
        $validated = $request->validate([
            "title" => "required",
            "first_name" => "required|string|max:255",
            "last_name" => "required|string|max:255",
            "gender" => "required",
            "birthday" => "nullable",
            "address_1" => "required|string",
            "address_2" => "nullable",
            "city" => "required|string|max:255",
            "postcode" => "required|string|max:255",
            "county" => "required|string|max:255",
            "phone" => "nullable",
            "mobile" => "required|string|max:255",
            "delivery_method" => "required"

        ]);

        // get the user from the request
        $user = $request->user();

        // update the user with the validated data
        $user->update($validated);

        // update the order with the validated data
        $order->update([
            'status' => 'processing',
            'payment_status' => 'paid',
            'address_1' => $validated['address_1'],
            'address_2' => $validated['address_2'],
            'city' => $validated['city'],
            'postcode' => $validated['postcode'],
            'county' => $validated['county'],
            'phone' => $validated['phone'],
            'mobile' => $validated['mobile'],
            'delivery_method' => $validated['delivery_method']

        ]);

        // update the cart and set the payment status to true
        $cart->update([
            'is_paid' => true
        ]);

        // remove the cart id from the session
        session()->forget('cart_id');

        return view('cart.thank-you', [
            'cart' => $cart
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateCartRequest  $request
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Cart $cart)
    {
         // validate the request
         $validated = $request->validate([
            'pizza_id' => 'required',
            'quantity' => 'required|numeric|min:1| max:10',
        ]);

        // create an instance of the product
        $pizza = (new Pizza())->findOrFail($validated['pizza_id']);

         // check if the product is already in the cart and remove
         $cart->pizzas()->detach($pizza->id);

          // calculate pizza total
          $pizza_total = $pizza->price  * $validated['quantity'] ;

              // check if there are any addons and add them to the pizza total
         if ($request->pizza_addons) {
            foreach ($request->pizza_addons as $addon) {
                $pizza_total += (new PizzaAddon())->findOrFail($addon)->value * $validated['quantity'];;
            }
        }

              // add the product to the cart
              $cart->pizzas()->attach([
                $pizza->id => [
                    'quantity' => $validated['quantity'],
                    'price' => $pizza->price,
                    'total' => $pizza_total,
                    'addons' => $request->pizza_addons ? json_encode($request->pizza_addons) : null,
                ]
            ]);





        // loop through the pizzas in the cart and calculate the total
        $cart->total = 0;
        foreach ($cart->pizzas as $pizza) {
            $cart->total += $pizza->pivot->total;
        }
        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Cart  $cart
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, Cart $cart)
    {
        $cart->pizzas()->detach($request->pizza_id);

        $cart->total = 0;
        foreach ($cart->pizzas as $pizza) {
            $cart->total += $pizza->pivot->total;
        }

        $cart->save();

        return redirect()->route('cart.show', $cart->id);
    }
}
