@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="p-5 bg-light rounded-3">
            <h2>My Cart- #{{ $cart->id }}<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 16V4H2V2h3a1 1 0 0 1 1 1v12h12.438l2-8H8V5h13.72a1 1 0 0 1 .97 1.243l-2.5 10a1 1 0 0 1-.97.757H5a1 1 0 0 1-1-1zm2 7a2 2 0 1 1 0-4 2 2 0 0 1 0 4zm12 0a2 2 0 1 1 0-4 2 2 0 0 1 0 4z"/></svg>
            </h2>
        </div>

        <div class="container">
            <div class="row">
                @if ($cart->pizzas && $cart->pizzas->count())
                    <div class="col-12">
                        <table class="table table-borderless">
                            <thead>
                                <tr>
                                   <th> </th>
                                    <th class="text-center">Quantity</th>
                                    <th class="text-center">Price</th>
                                    <th class="text-center">Total</th>
                                    <th> </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($cart->pizzas as $pizza)
                                    <tr>
                                        <td class="col-sm-8 col-md-6">
                                            <div class="media">
                                                <a class="thumbnail pull-left"> <img class="media-object"
                                                        src="{{ asset('storage/' . $pizza->image) }}"
                                                        style="width: 110px; height: 110px;"> </a>
                                                <div class="media-body">
                                                    <h4 class="media-heading"> {{ $pizza->name }}</a></h4>
                                                    <p> {{ $pizza->summary }}</a></p>

                                                    @if ($pizza->pivot->addons)
                                                    Product Addons
                                                    <ul>
                                                        @foreach (json_decode($pizza->pivot->addons) as $addons)
                                                            <li>
                                                                {{ \App\Models\PizzaAddon::find($addons)->name }}
                                                                $ {{ number_format(\App\Models\PizzaAddon::find($addons)->value, 2) }}
                                                            </li>
                                                        @endforeach
                                                    </ul>
                                                @endif

                                                    <span>Status: </span>
                                                    <span class="text-success">
                                                        <strong>In Stock</strong>
                                                    </span>
                                                </div>
                                            </div>
                                        </td>
                                        <td class="col-sm-1 col-md-1" style="text-align: center">
                                            <form action="{{ route('cart.update', $cart->id) }}" method="POST"
                                                class="d-inline">
                                                @csrf
                                                @method('PUT')
                                                <input type="hidden" name="pizza_id" value="{{ $pizza->id }}" />
                                                <input type="number" class="form-control" name="quantity"
                                                value="{{ $pizza->pivot->quantity }}">
                                                <button type="submit" class="btn btn-sm mt-1 btn-success">
                                                    <span class="glyphicon glyphicon-remove"></span> Update
                                                </button>
                                            </form>
                                        </td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>$
                                                {{ number_format($pizza->pivot->price, 2) }}</strong></td>
                                        <td class="col-sm-1 col-md-1 text-center"><strong>$
                                                {{ number_format($pizza->pivot->total, 2) }}</strong></td>
                                        <td class="col-sm-1 col-md-1">
                                            <form action="{{ route('cart.destroy', $cart->id) }}" method="POST"
                                                id="delete-{{ $pizza->id }}-pizza" class="d-inline">
                                                @csrf
                                                @method('DELETE')
                                                <input type="hidden" name="pizza_id" value="{{ $pizza->id }}" />
                                                <button type="button" class="btn btn-sm btn-danger"
                                                    onclick="confirm('Are you sure you want to remove {{ $pizza->name }} ?') ? document.getElementById('delete-{{ $pizza->id }}-pizza').submit() : null">
                                                    <span class="glyphicon glyphicon-remove"></span> Remove
                                                </button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach

                                <tr>
                                    <hr>

                                    <td>   </td>
                                    <td>   </td>
                                    <td>   </td>
                                    <td>
                                        <h3>Total:</h3>
                                    </td>
                                    <td class="text-right">
                                        <h3><strong> £ {{ number_format($cart->total, 2) }}</strong></h3>
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="5" class="text-end">
                                        <a href="{{ route('cart.checkout', $cart->id) }}" class="btn btn-success btn-lg">
                                            Checkout
                                        </a>
                            </tbody>
                        </table>
                        <hr>

                    </div>
                @else
                <div>
                <div style="text-align: center; margin-top: 20px;">
                  <h1>  Your Cart is empty!</h1>
                    <br>
                    <br>
                    <img src="https://www.sportsdrive.in/images/empty-cart.png"/>
                    <br>
                    <br>
                    <a href="{{ url('/home')}}" class="btn btn-md btn-success">Click here to add items to your cart!</a>
                    <br>
                    <br>
                </div>
                @endif
            </div>
        </div>

    </div>
@endsection
